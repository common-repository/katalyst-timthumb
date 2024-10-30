<?php if( __FILE__ == $_SERVER['SCRIPT_FILENAME'] ){ header('Status: 403 Forbidden'); header('HTTP/1.1 403 Forbidden'); exit(); } ?>
<?php
/*
Plugin Name: Katalyst TimThumb
Plugin URI: 
Description: Automatically converts post thumbnails to the theme default dimension settings.
Author: Lucas Keiser
Version: 1.0
Author URI: http://www.keisermedia.com/

    Copyright 2010-2012  Lucas Keiser  (email : webmaster@keisermedia.com)

	This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/

class Katalyst_TimThumb{
	
	function __construct(){
		register_deactivation_hook(__FILE__, array(&$this, 'remove_cache') );
		
		add_filter('post_thumbnail_html', array(&$this, 'thumbnail_filter'), 10, 5);
	}
	
	function remove_cache(){
		$directory = dirname(__FILE__) . '/cache';
		
		foreach( glob($directory . '/*') as $file ){
        	if( !is_dir($file) && $file != $directory . '/index.php' )
            	unlink($file);
    	}
	}
	
	function thumbnail_filter($html, $post_id, $post_thumbnail_id, $size, $attr){
		global $blog_id, $_wp_additional_image_sizes;

		$image = wp_get_attachment_image_src($post_thumbnail_id, 'full');
		
		if( isset($blog_id) && $blog_id > 0 ){
			$image_parts = explode('/files/', $image[0]);
			if( isset($image_parts[1]) ) {
				$image[0] = '/blogs.dir/' . $blog_id . '/files/' . $image_parts[1];
			}
		}
		
		if( is_array($size) || isset($_wp_additional_image_sizes[$size]) ){
			$img_size[0] = ( !is_array($size) ) ? $_wp_additional_image_sizes[$size]['width'] : $size[0];
			$img_size[1] = ( !is_array($size) ) ?  $_wp_additional_image_sizes[$size]['height'] : $size[1];
			
			$patterns = array('/width="(.*?)" height="(.*?)" /', '/src="(.*?)"/');
			$replacements = array('', 'src="'.plugins_url('katalyst-timthumb').'/timthumb.php?src='.$image[0].'&amp;w='.$img_size[0].'&amp;h='.$img_size[1].'&amp;zc=1"');
			$html = preg_replace($patterns, $replacements, $html);
		}else
			trigger_error('\'' . $size . '\' image size not set. Add WordPress function: add_image_size() to theme file "functions.php" to ensure proper functionality of Katalyst TimThumb.');
		
		return $html;
	}
	
}

$timthumb = new Katalyst_TimThumb;