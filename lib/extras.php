<?php
/**
 * Clean up the_excerpt()
 */
function roots_excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Read more', 'roots') . '</a>';
}
add_filter('excerpt_more', 'roots_excerpt_more');
