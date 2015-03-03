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