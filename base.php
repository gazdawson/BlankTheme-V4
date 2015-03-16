<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>

  <!--[if lt IE 8]>
    <div class="alert alert-warning">
      <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?>
    </div>
  <![endif]-->

  <?php
    do_action('get_header');
    get_template_part('templates/header');
  ?>

  <div class="wrap container" role="document">
    <div class="content row">
      <main class="main" role="main">
        <?php include roots_template_path(); ?>
      </main><!-- /.main -->
      <?php if (roots_display_sidebar()) : ?>
        <aside class="sidebar" role="complementary">
          <?php include roots_sidebar_path(); ?>
        </aside><!-- /.sidebar -->
      <?php endif; ?>
    </div><!-- /.content -->
  </div><!-- /.wrap -->

  <?php get_template_part('templates/footer'); ?>

  <?php wp_footer(); ?>
	
<div id="gallery-modal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
      </div>
			<div class="caption"></div>
      <div class="modal-body">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
			
			<script>
	    $(document).ready(function() {

				$('li.gallery-image').click(function(e) {
					
					// Get image src and create html img.
					var imgPath = $(this).find('a.thumbnail').data('imgpath');
					var img = '<img src="' + imgPath + '" class="img-responsive"/>';
					// Get Image Caption
					var caption = $(this).data('caption');
					
					// Prevent default link open
					e.preventDefault();
					// Insert image path into image src
					$('#gallery-modal img').attr('src', imgPath);
					// Get image Index Number
					var index = $(this).index();
					// write modal html image and controls             
          var html = '';
          html += img;
					if (caption != '') {
						html += '<div class="caption">'+ caption +'</div>';
					}
          html += '<div class="gallery-control">';
          html += '<a class="controls previous" href="' + (index) + '"><i class="fa fa-angle-left"></i></a>';
					html += '<a class="controls next" href="'+ (index+2) + '"><i class="fa fa-angle-right"></i></a>';
          html += '</div>';
					// open photo modal
					$("#gallery-modal").modal();
          $('#gallery-modal').on('shown.bs.modal', function(){
              $('#gallery-modal .modal-body').html(html);
          });
          $('#gallery-modal').on('hidden.bs.modal', function(){
              $('#gallery-modal .modal-body').html('');
          });
					
				});
						
				$(document).on('click', '#gallery-modal a.controls', function() {
					
					var index = $(this).attr('href');
					// Get next image path and caption if it has one
					var src = $('ul.row li:nth-child('+ index +') a').data('imgpath');
					var caption = $('ul.row li:nth-child('+ index +')').data('caption');
					         
					// update image src and replace caption text
					$('.modal-body img').attr('src', src);
					$('.modal-content .caption').text(caption);
	
					var newPrevIndex = parseInt(index) - 1; 
					var newNextIndex = parseInt(newPrevIndex) + 2; 
	
					if($(this).hasClass('previous')){               
						$(this).attr('href', newPrevIndex); 
						$('a.next').attr('href', newNextIndex);
					}else{
						$(this).attr('href', newNextIndex); 
						$('a.previous').attr('href', newPrevIndex);
					}
	
					var total = $('ul.row li').length + 1; 
					//hide next button
					if(total === newNextIndex){
						$('a.next').hide();
					}else{
						$('a.next').show()
					}            
					//hide previous button
					if(newPrevIndex === 0){
						$('a.previous').hide();
					}else{
						$('a.previous').show()
					}
					return false;
				});
						
			});
			
			</script>

</body>
</html>


