/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can 
 * always reference jQuery with $, even when in .noConflict() mode.
 *
 * Google CDN, Latest jQuery
 * To use the default WordPress version of jQuery, go to lib/config.php and
 * remove or comment out: add_theme_support('jquery-cdn');
 * ======================================================================== */

(function($) {

// Use this variable to set up the common and page specific functions. If you 
// rename this variable, you will also need to rename the namespace below.
var Roots = {
  // All pages
  common: {
    init: function() {
      
		// Jump to top link
		$(window).scroll(function() {
			if($(this).scrollTop() > 100) {
				$('#to-top').fadeIn(300);
			} else {
				$('#to-top').fadeOut(300);
			}
		});
		// Jump to top link animate scroll
		$('#to-top').click(function(event) {
			event.preventDefault();
			$('html, body').animate({scrollTop: 0}, 300);
		});
		
		// Contact Form Validation 
		$('#contact-form').formValidation({
			framework: 'bootstrap',
			icon: {
				valid: 'fa fa-check',
				invalid: 'fa fa-times',
				validating: 'fa fa-refresh'
			},
			fields: {
				your_name: {
					validators: {
						notEmpty: {
							message: 'Please enter your name.'
						}
					}
				},
				email: {
					validators: {
						notEmpty: {
							message: 'Please enter an email address.'
						},
						emailAddress: {
							message: 'Please enter a valid email address.'
						}
					}
				},
				number: {
					validators: {
						notEmpty: {
							message: 'Please enter a contact number.'
						}
					}
				},
				message: {
					validators: {
						notEmpty: {
							message: 'A message is required.'
						}
					}
				},
			}
		});
		
		// open gallery images in bootstrap modal
		$('li.gallery-image').click(function(e) {
			// Get image src and create html img.
			var imgPath = $(this).find('a').data('imgpath');
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
				html += '<div class="caption">'+ caption +'</div>';
				html += '<div class="gallery-control">';
				html += '<a class="controls previous" href="' + (index) + '"><i class="fa fa-angle-left"></i></a>';
				html += '<a class="controls next" href="'+ (index+2) + '"><i class="fa fa-angle-right"></i></a>';
				html += '</div>';

			// open photo modal
			$("#gallery-modal").modal();
			$('#gallery-modal').on('shown.bs.modal', function(){
				$('#gallery-modal .modal-body').html(html);
				
				// hide image before its loaded
				$('.modal-body img').hide();
				
				// check if image loaded.
				$('.modal-body img').load(function(){
					$('.modal-body img').fadeIn('slow');
					// hide caption if empty
					if(caption === '') {
						$('.modal-body .caption').hide();
					} else {
						$('.modal-body .caption').hide().delay(500).fadeIn('fast');
					}
				});
			
			});
			$('#gallery-modal').on('hidden.bs.modal', function(){
				$('#gallery-modal .modal-body').html('');
			});
		});
		
		$('#gallery-modal a.controls').click(function(){
			$('.modal-body img').hide();
		});
		
		// add previous and next buttons to modal and dynamicvally load content
		$(document).on('click', '#gallery-modal a.controls', function() {
			var index = $(this).attr('href');
			// Get next image path and caption if it has one
			var src = $('ul.gallery-row li:nth-child('+ index +') a').data('imgpath');
			var caption = $('ul.gallery-row li:nth-child('+ index +')').data('caption');
			
			// hide old image and update new image src
			$('.modal-body img').hide();
			$('.modal-body img').attr('src', src);
			
			
			$('.modal-body img').load(function(){
				$('.modal-body img').fadeIn('slow');
				$('.modal-body .loader').hide();
			});
			
			// hide caption
			$('.modal-body .caption').hide();
			
			if(caption !== '') {
				$('.modal-body .caption').text(caption).delay(500).fadeIn('fast');
			} else {
				$('.modal-body .caption').hide().text('');
			}
			
			var newPrevIndex = parseInt(index) - 1;
			var newNextIndex = parseInt(newPrevIndex) + 2;

			if($(this).hasClass('previous')) {
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
				$('a.next').show();
			}
			//hide previous button
			if(newPrevIndex === 0){
				$('a.previous').hide();
			}else{
				$('a.previous').show();
			}
			return false;
		});
		
    }
  },
  // Home page
  home: {
    init: function() {
      // JavaScript to be fired on the home page
    }
  },
  // About us page, note the change from about-us to about_us.
  about_us: {
    init: function() {
      // JavaScript to be fired on the about us page
    }
  }
};

// The routing fires all common scripts, followed by the page specific scripts.
// Add additional events for more control over timing e.g. a finalize event
var UTIL = {
  fire: function(func, funcname, args) {
    var namespace = Roots;
    funcname = (funcname === undefined) ? 'init' : funcname;
    if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
      namespace[func][funcname](args);
    }
  },
  loadEvents: function() {
    UTIL.fire('common');

    $.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
      UTIL.fire(classnm);
    });
  }
};

$(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
