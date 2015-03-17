<?php
/**
 * Clean up gallery_shortcode()
 *
 * Re-create the [gallery] shortcode and use thumbnails styling from Bootstrap
 * The number of columns must be a factor of 12.
 *
 * @link http://getbootstrap.com/components/#thumbnails
 */
function roots_gallery($attr) {
  $post = get_post();

  static $instance = 0;
  $instance++;

  if (!empty($attr['ids'])) {
    if (empty($attr['orderby'])) {
      $attr['orderby'] = 'post__in';
    }
    $attr['include'] = $attr['ids'];
  }

  $output = apply_filters('post_gallery', '', $attr);

  if ($output != '') {
    return $output;
  }

  if (isset($attr['orderby'])) {
    $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
    if (!$attr['orderby']) {
      unset($attr['orderby']);
    }
  }

  extract(shortcode_atts(array(
    'order'      => 'ASC',
    'orderby'    => 'menu_order ID',
    'id'         => $post->ID,
    'itemtag'    => '',
    'icontag'    => '',
    'captiontag' => '',
    'columns'    => 4,
    'size'       => 'thumbnail',
    'include'    => '',
    'exclude'    => '',
    'link'       => 'file'
  ), $attr));

  $id = intval($id);
  $columns = (12 % $columns == 0) ? $columns: 4;
  $grid = sprintf('col-sm-%1$s col-lg-%1$s', 12/$columns);

  if ($order === 'RAND') {
    $orderby = 'none';
  }

  if (!empty($include)) {
    $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

    $attachments = array();
    foreach ($_attachments as $key => $val) {
      $attachments[$val->ID] = $_attachments[$key];
    }
  } elseif (!empty($exclude)) {
    $attachments = get_children(array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
  } else {
    $attachments = get_children(array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
  }

  if (empty($attachments)) {
    return '';
  }

  if (is_feed()) {
    $output = "\n";
    foreach ($attachments as $att_id => $attachment) {
      $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
    }
    return $output;
  }

  $unique = (get_query_var('page')) ? $instance . '-p' . get_query_var('page'): $instance;
  $output = '<div class="gallery gallery-' . $id . '-' . $unique . '">';


	$output .= '<ul class="gallery-row '.$size.'">';

  $i = 0;
  foreach ($attachments as $id => $attachment) {
    switch($link) {
      case 'file':
        $image = wp_get_attachment_link($id, $size, false, false);
        break;
      case 'none':
        $image = wp_get_attachment_image($id, $size, false, array('class' => 'img-thumbnail'));
        break;
      default:
        $image = wp_get_attachment_link($id, $size, true, false);
        break;
    }
    $output .= '<li class="gallery-image" data-caption="'.wptexturize($attachment->post_excerpt).'">' . $image;

    $output .= '</li>';
    $i++;
  }
  $output .= '</ul>';
	$output .= '</div>';
	
	// add gallery bootstrap modal
	$output .= 
		'<div id="gallery-modal" class="modal fade">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
		      </div>
					<span class="loader"><i class="fa fa-circle-o-notch fa-spin"></i></span>
		      <div class="modal-body">
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /#gallery-modal .modal -->';

  return $output;
}
if (current_theme_supports('bootstrap-gallery')) {
  remove_shortcode('gallery');
  add_shortcode('gallery', 'roots_gallery');
  add_filter('use_default_gallery_style', '__return_null');
}

/**
 * Add class="thumbnail img-thumbnail" to attachment items
 */
function roots_attachment_link_class($html) {
  $postid = get_the_ID();
  $html = str_replace('<a href=', '<a data-toggle="modal" href="#" data-imgpath=', $html);
  return $html;
}
add_filter('wp_get_attachment_link', 'roots_attachment_link_class', 10, 1);
