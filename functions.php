<?php
/**
 * File Name functions.php
 * @package WordPress
 * @subpackage ParentTheme_VC
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.2
 * @updated 03.17.13
 **/
#################################################################################################### */






/**
 * AppendPostData Wrapper
 *
 * @version 1.0
 * @updated	03.16.13
 *
 * Description:
 * This helper function is a wrapper for the class. It is not needed, and is 
 * intended to be used as an easy way to include the class and initiate the 
 * functionality.
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
		
		$output = false;
			
	}
	
	return $output;
	
} // end function append__post_data