<?php
/**
 * File Name functions.php
 * @package WordPress
 * @subpackage ParentTheme_VC
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.9
 * @updated 02.09.13
 **/
#################################################################################################### */






/**
 * AppendPostData Wrapper
 *
 * @version 1.0
 * @updated	03.16.13
 **/
function append__post_data( $options ) {
	
	if ( ! class_exists( 'AppendPostData' ) ) {
		
		// require_once( get_stylesheet_directory() . '/includes/classes/AppendPostData.php' );
		require_once( get_template_directory() . '/includes/classes/AppendPostData.php' );
		
		if ( class_exists( 'AppendPostData' ) ) {
			
			$AppendPostData = new AppendPostData();
			$AppendPostData->init( $options );
			$output = true;
		}
		
		$output = true;
			
	}
	
	return $output;
	
} // end function append__post_data