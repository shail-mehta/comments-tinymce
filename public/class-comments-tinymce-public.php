<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://profiles.wordpress.org/shailu25
 * @since      1.0.0
 *
 * @package    Comments_Tinymce
 * @subpackage Comments_Tinymce/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Comments_Tinymce
 * @subpackage Comments_Tinymce/public
 *
 */
class Comments_Tinymce_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Comments_Tinymce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Comments_Tinymce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/comments-tinymce-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_deregister_script('comment-reply');
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/comments-tinymce-public.js', array( 'jquery' ), $this->version, false );

	}

	 public function comment_tinymce_form_defaults($args) {
	    ob_start();
	    wp_editor( '', 'comment', array(
	        'media_buttons' => true,
	        'textarea_rows' => '10',
	        'dfw' => false,
	        'tinymce' => array( 'theme_advanced_buttons1' => 'bold,italic,underline,strikethrough,bullist,numlist,code,blockquote,link,unlink,outdent,indent,|,undo,redo,fullscreen',
	            'theme_advanced_buttons2' => '', 
	            'theme_advanced_buttons3' => '',
	            'theme_advanced_buttons4' => ''
	        )
	    ) );
	    $args['comment_field'] = ob_get_clean();
	    return $args;
    }
    
	/* Allow Tags in Comment Form Editor */ 
    function comment_tinymce_form_allowed_tags() {
		    global $allowedtags;
		    $allowedtags['ul'] = array();
		    $allowedtags['ol'] = array();
		    $allowedtags['li'] = array();
		    $allowedtags['strong'] = array();
		    $allowedtags['ins'] = array(
		        'datetime' => true
		    );
		    $allowedtags['del'] = array(
		        'datetime' => true
		    );
		    $allowedtags['pre'] = array(
		        'lang' => true,
		        'line' => true
		    );
		    $allowedtags['span'] = array(
		        'style' => true
		    );
		    $allowedtags['img'] = array(
		        'width' => true,
		        'height' => true,
		        'src' => true,
		        'alt' => true
		    );
		    $allowedtags['a'] = array(
		        'target' => true,
		        'href' => true,
		        'title' => true,
		    );
	}
}