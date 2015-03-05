<?php
	// Define Vars
	$modal_id = $this->modal_id;
	$modal_btn_txt = $this->modal_btn_txt;
	$modal_header = $this->modal_header;
	$modal_title = $this->modal_title;
	$modal_template = $this->modal_template;
	$modal_content = $this->modal_content;
	$modal_footer = $this->modal_footer;
	$modal_footer_content = $this->modal_footer_content;
?>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="<?php echo '#'. $modal_id; ?>">
  <?php echo $modal_btn_txt; ?>
</button>

<div class="modal fade" id="<?php echo $modal_id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
			
			<?php if($modal_header != false) :?>
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><?php echo $modal_title; ?></h4>
	      </div>
			<?php endif;?>
			
      <div class="modal-body">
        <?php if($modal_template):
					get_template_part($modal_template);
				endif; ?>
				<?php echo $modal_content; ?>
      </div>
			
			<?php if($modal_header != false) :?>
				
	      <div class="modal-footer">
					<?php echo $modal_footer_content; ?>
	      </div>
			
			<?php endif;?>
			
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /<?php echo '#'. $modal_id; ?> .modal -->