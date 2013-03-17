# AppendPostData #

A simple class with a helper function for appending custom fields to the $post object via "the_post" filter. I put this together pretty quick so I'm positive there is room for improvement.

[https://github.com/vc27/AppendPostData/](https://github.com/vc27/AppendPostData/)

## Info ##
The purpose of this class is to append custom field values to the post object. Using this method will lessen the amount of code needed with in "the loop". Rather than writing code with "the loop" you may utilize this class and it's filter to append items to the post object for usage like the following.


## Helper Function ##
<pre><code>
	
	// Options Array
	$option = array(
		'post_type' => array( 'post' ), // Array of post_types
		'custom_fields' => array( // array of post_meta fields
			array(
				'meta_key' => 'some_customfield_name',
				'unique' => 1,
				),
			array(
				'meta_key' => 'another_awesome_customfield',
				'unique' => 1,
				),
			),
		);
	
	
	// Helper Function usage
	append__post_data( $option );
	
	
	// Class Usage
	$AppendPostData = new AppendPostData();
	$AppendPostData->init( $options );
	
	
	/**
	 * $post usage
	 * You would not have access to the following values with in the post object.
	 **/
	$post->some_customfield_name; 
	$post->another_awesome_customfield;
	
</code></pre>


## Class Usage ##
<pre><code>
	
	// Options Array
	$option = array(
		'post_type' => array( 'post' ), // Array of post_types
		'custom_fields' => array( // array of post_meta fields
			array(
				'meta_key' => 'some_customfield_name',
				'unique' => 1,
				),
			array(
				'meta_key' => 'another_awesome_customfield',
				'unique' => 1,
				),
			),
		);
	
	
	// Class Usage
	$AppendPostData = new AppendPostData();
	$AppendPostData->init( $options );
	
	
	/**
	 * $post usage
	 * You would not have access to the following values with in the post object.
	 **/
	$post->some_customfield_name; 
	$post->another_awesome_customfield;
	
</code></pre>
