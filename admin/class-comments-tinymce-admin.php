<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://profiles.wordpress.org/shailu25
 * @since      1.0.0
 *
 * @package    Comments_Tinymce
 * @subpackage Comments_Tinymce/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Comments_Tinymce
 * @subpackage Comments_Tinymce/admin
 *
 */
class Comments_Tinymce_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/comments-tinymce-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/comments-tinymce-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function comment_tinymce_admin_menu() {
		add_menu_page(
			__( 'Comment Tinymce Settings', 'comments-tinymce' ),
			'Comment Form Editor with TinyMCE',
			'manage_options',
			'comment-tinymce',
			array($this, 'comment_tinymce_options'),
			'dashicons-admin-comments',
			30
		);
	}

	/**
	 * Plugin settings link
	 * 
	 * @since    1.0.0
	 */
	public function comment_tinymce_settings_link( array $links ) {
	    $url = get_admin_url() . "admin.php?page=comment-tinymce";
		$settings_link = '<a href="' . $url . '">' . __('Settings', 'comments-tinymce') . '</a>';
		  	$links[] = $settings_link;
		return $links;
	}

	public function comment_tinymce_options() {

		// HTML Form inside this file
		include plugin_dir_path( dirname( __FILE__ ) ).'admin/partials/comments-tinymce-admin-display.php';
	
	}
	

	public function comment_tinymce_update_settings(){

		$comment_tinymce_object = new Comments_Tinymce;
		$comment_tinymce_options = $comment_tinymce_object->comment_tinymce_get_options();


		if ( ! current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		
		if ( ! empty( $_POST ) && check_admin_referer( -1, 'save_comment_tinymce_options' ) ) {

			if ( $comment_tinymce_options['comment_tinymce_heading_one'] !== false ) {
				update_option( 'comment_tinymce_heading_one', sanitize_text_field($_POST['comment_tinymce_heading_one']) );
			} else {
				add_option( 'comment_tinymce_heading_one', sanitize_text_field($_POST['comment_tinymce_heading_one']), null, 'no' );
			}

			if ( $comment_tinymce_options['comment_tinymce_heading_two'] !== false ) {
				update_option( 'comment_tinymce_heading_two', sanitize_text_field($_POST['comment_tinymce_heading_two']) );
			} else {
				add_option( 'comment_tinymce_heading_two', sanitize_text_field($_POST['comment_tinymce_heading_two']), null, 'no' );
			}

			if ( $comment_tinymce_options['comment_tinymce_heading_three'] !== false ) {
				update_option( 'comment_tinymce_heading_three', sanitize_text_field($_POST['comment_tinymce_heading_three']) );
			} else {
				add_option( 'comment_tinymce_heading_three', sanitize_text_field($_POST['comment_tinymce_heading_three']), null, 'no' );
			}

			if ( $comment_tinymce_options['comment_tinymce_heading_four'] !== false ) {
				update_option( 'comment_tinymce_heading_four', sanitize_text_field($_POST['comment_tinymce_heading_four']) );
			} else {
				add_option( 'comment_tinymce_heading_four', sanitize_text_field($_POST['comment_tinymce_heading_four']), null, 'no' );
			}

			if ( $comment_tinymce_options['comment_tinymce_heading_five'] !== false ) {
				update_option( 'comment_tinymce_heading_five', sanitize_text_field($_POST['comment_tinymce_heading_five']) );
			} else {
				add_option( 'comment_tinymce_heading_five', sanitize_text_field($_POST['comment_tinymce_heading_five']), null, 'no' );
			}

			if ( $comment_tinymce_options['comment_tinymce_heading_six'] !== false ) {
				update_option( 'comment_tinymce_heading_six', sanitize_text_field($_POST['comment_tinymce_heading_six']) );
			} else {
				add_option( 'comment_tinymce_heading_six', sanitize_text_field($_POST['comment_tinymce_heading_six']), null, 'no' );
			}

			if ( $comment_tinymce_options['comment_tinymce_media_btn'] !== false ) {
				update_option( 'comment_tinymce_media_btn', sanitize_text_field($_POST['comment_tinymce_media_btn']) );
			} else {
				add_option( 'comment_tinymce_media_btn', sanitize_text_field($_POST['comment_tinymce_media_btn']), null, 'no' );
			}

			if ( $comment_tinymce_options['comment_tinymce_pre_tag'] !== false ) {
				update_option( 'comment_tinymce_pre_tag', sanitize_text_field($_POST['comment_tinymce_pre_tag']) );
			} else {
				add_option( 'comment_tinymce_pre_tag', sanitize_text_field($_POST['comment_tinymce_pre_tag']), null, 'no' );
			}

			wp_redirect( admin_url( 'admin.php?page=comment-tinymce&update-status=true' ) );

		}
	}
}
