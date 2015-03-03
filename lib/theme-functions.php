<?php
/**
 * Krank Custom Functions
 * @package Krank
*/


// pass varibles to template file class
if ( ! class_exists('krank_templateView') ) {
    class krank_templateView {
        private $args;
        private $file;
 
        public function __get($name) {
            return $this->args[$name];
        }
 
        public function __construct($file, $args = array()) {
            $this->file = $file;
            $this->args = $args;
        }
 
        public function __isset($name){
            return isset( $this->args[$name] );
        }
 
        public function render() {
            if( locate_template($this->file) ){
                include( locate_template($this->file) );//Theme Check free. Child themes support.
            }
        }
    }
}
// pass varibles to template file function
if( ! function_exists('krank_get_template_part') ){
    function krank_get_template_part($file, $args = array()){
        $template = new krank_templateView($file, $args);
        $template->render();
    }
}

// Structured Data Address
function krank_structured_business() {
	// Declare Variables
	global $krank;
	$address_lines = $contact_lines = $open_lines = '';
	
	// Business Name
	if($krank['name']) {
		$business_name = $krank['name'];
	}
	// Address Loop
	foreach($krank['address'] as $key => $value) {
		if($value) {
			$address_lines .= '<span itemprop="'.$key.'">'.$value.'</span> ';
		}
	}
	foreach($krank['contact'] as $key => $value) {
		if($value) {
			$contact_lines .= '<abbr title="'.ucFirst($key).'">'.substr($key,0,1).': </abbr><span itemprop="'.$key.'">'.$value.'</span> ';
		}
	}
	foreach($krank['open'] as $key => $value) {
		if($value) {
			$opens = substr($value,0,5).':00';
			$closes = substr($value,8,99).':00';
			$open_lines .= 
				'<span itemprop="dayOfWeek" itemscope itemtype="http://schema.org/DayOfWeek">
					<span itemprop="name">'.$key.'</span>
				</span>
				<meta itemprop="opens" content="'.$opens.'">
				<meta itemprop="closes" content="'.$closes.'">';
		}
	}
	// Address HTML with Google structured data
	$business_info =
		'<div itemscope itemtype="http://schema.org/LocalBusiness" class="business-info">'.
			'<span class="copy">&copy; '.date('Y').' </span>'.
			'<span itemprop="name" class="name">'.$business_name.' | </span>
			 <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress" class="address">'.
				$address_lines.
			'</div><!--/.address-->
			<div class="contact">'.
				$contact_lines.
			'</div><!--/.contact-->
			<div itemprop="openingHoursSpecification" itemscope itemtype="http://schema.org/OpeningHoursSpecification" class="opening">'.
				$open_lines.
			'</div><!--/.opening-->
		  </div>';
	// Location HTML with Google structured data
	$location =
		'<div itemscope itemtype="http://schema.org/Place" class="location">
		  <div itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
		    <meta itemprop="latitude" content="'.$krank['location']['latitude'].'" />
		    <meta itemprop="longitude" content="'.$krank['location']['longitude'].'" />
		  </div>
		</div>';
		
	// Return Output
	return $business_info.$location;
}