<?php
/**
 * File Name AppendPostData.php
 * @package WordPress
 * @subpackage ParentTheme_VC
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.1
 * @updated 03.17.13
 **/
####################################################################################################




/* 
Example options array to be given to the init($options) method
$options = array(
	'post_type' => array( 'post' ), // Array of post types
	'custom_fields' => array( // array of post_meta fields
		array(
			'meta_key' => 'some_custom_field_name',
			'unique' => 1,
			),
		),
	);
*/



/**
 * AppendPostData
 *
 * @version 1.0
 * @updated 03.15.13
 **/
class AppendPostData {
	
	
	/**
	 * Post Object
	 * 
	 * @access public
	 * @var object
	 **/
	var $post = 0;
	
	
	/**
	 * have_custom_fields
	 * 
	 * @access public
	 * @var bool
	 **/
	var $have_custom_fields = 0;
	
	
	/**
	 * custom_fields
	 * 
	 * @access public
	 * @var array
	 **/
	var $custom_fields = array();
	
	
	
	
	
	
	/**
	 * init
	 *
	 * @version 1.0
	 * @updated 03.15.13
	 *
	 * Description:
	 * Accept an array of arguments to pass along to 'the_post' filter
	 **/
	function init( $args ) {
		
		$this->set_args( $args );
		add_filter( 'the_post', array( &$this, 'the_post' ) );

	} // end function init
	
	
	
	
	
	
	/**
	 * get
	 *
	 * @version 1.0
	 * @updated 03.15.13
	 **/
	function get( $key ) {
		
		if ( isset( $this->$key ) AND ! empty( $this->$key ) ) {
			return $this->$key;
		} else {
			return false;
		}
		
	} // end function get
	
	
	
	
	
	
	/**
	 * set
	 *
	 * @version 1.0
	 * @updated 03.15.13
	 **/
	function set( $key, $val = false ) {
		
		if ( isset( $key ) AND ! empty( $key ) ) {
			$this->$key = $val;
		}
		
	} // end function set 
	
	
	
	
	
	
	/**
	 * add_to_post
	 *
	 * @version 1.0
	 * @updated 03.15.13
	 * 
	 * Description:
	 * Append key = value to the 'post' object.
	 **/
	function add_to_post( $key, $val = false ) {
		
		if ( isset( $key ) AND ! empty( $key ) ) {
			$this->post->$key = $val;
		}
		
	} // end function add_to_post
	
	
	
	
	
	
	/**
	 * set_args
	 *
	 * @version 1.0
	 * @updated 03.15.13
	 * 
	 * Description:
	 * Add incoming arguments to the current object instance.
	 **/
	function set_args( $args ) {
		
		$this->set( 'args', $args );
		
		if ( is_array( $this->args ) AND ! empty( $this->args ) ) {
			
			foreach ( $this->args as $k => $val ) {
				$this->set( $k, $val );
			}
			
		}
		
	} // end function set_args
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * the_post
	 * 
	 * @version 1.0
	 * @updated 03.15.13
	 * 
	 * Description:
	 * Filter 'the_post' and return it's value.
	 **/
	function the_post( $post ) {
		
		$this->set( 'post', $post );
		
		if ( $this->have_custom_fields() AND $this->is_post_type() ) {
			
			$this->append_custom_fields();
			
		}
		
		return $this->post;
		
	} // end function the_post
	
	
	
	
	
	
	/**
	 * append_custom_fields
	 * 
	 * @version 1.1
	 * @updated 03.15.13
	 * 
	 * Description:
	 * Loop through custom_fields and append each value to the 
	 * 'post' object.
	 **/
	function append_custom_fields() {
		
		foreach ( $this->custom_fields as $this->custom_field ) {
			$this->set_single_custom_field();
			$this->add_to_post( $this->meta_key, apply_filters( "append-post-data-$this->post_type", get_post_meta( $this->post->ID, $this->meta_key, $this->unique ), $this ) );
		}
		
	} // end function append_custom_fields 
	
	
	
	
	
	
	/**
	 * set_single_custom_field
	 * 
	 * @version 1.1
	 * @updated 03.15.13
	 * 
	 * Description:
	 * set single custom field value with in the current object.
	 **/
	function set_single_custom_field() {
		
		if ( is_array( $this->custom_field ) ) {
			foreach ( $this->custom_field as $key => $val ) {
				$this->set( $key, $val );
			}
		}
		
	} // end function set_single_custom_field
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Conditionals
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * is_post_type
	 * 
	 * @version 1.0
	 * @updated 03.15.13
	 * 
	 * Description:
	 * Set post type bool with in object for usage and return it's value.
	 **/
	function is_post_type() {
		
		if ( isset( $this->post_type ) AND ! empty( $this->post_type ) AND is_array( $this->post_type ) AND in_array( $this->post->post_type, $this->post_type ) ) {
			$this->set( 'is_post_type', 1 );
		} else {
			$this->set( 'is_post_type', 0 );
		}
		
		return $this->is_post_type;
		
	} // end function have_custom_fields
	
	
	
	
	
	
	/**
	 * have_custom_fields
	 * 
	 * @version 1.0
	 * @updated 03.15.13
	 * 
	 * Description:
	 * Set custom fields bool with in object for usage and return it's value.
	 **/
	function have_custom_fields() {
		
		if ( isset( $this->custom_fields ) AND is_array( $this->custom_fields ) AND ! empty( $this->custom_fields ) ) {
			$this->set( 'have_custom_fields', 1 );
		} else {
			$this->set( 'have_custom_fields', 0 );
		}
		
		return $this->have_custom_fields;
		
	} // end function have_custom_fields
	
	
	
} // end class AppendPostData