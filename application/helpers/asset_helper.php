<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//TES
/**
 * Returns path of images folder
 * @return string
 */
function images_url(){
	return base_url()."_assets/images/";
}

/**
 * Returns path of css folder
 * @return string
 */
function css_url(){
	return base_url()."_assets/css/";
}

/**
 * Returns path of js folder
 * @return string
 */
function js_url(){
	return base_url()."_assets/js/";
}

/**
 * Returns path of fonts folder
 * @return string
 */
function fonts_url(){
	return base_url()."_assets/fonts/";
}

function test(){

}


?>
