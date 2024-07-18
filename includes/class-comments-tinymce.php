<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://profiles.wordpress.org/shailu25
 * @since      1.0.0
 *
 * @package    Comments_Tinymce
 * @subpackage Comments_Tinymce/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Comments_Tinymce
 * @subpackage Comments_Tinymce/includes
 *
 */
class Comments_Tinymce {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Comments_Tinymce_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'COMMENTS_TINYMCE_VERSION' ) ) {
			$this->version = COMMENTS_TINYMCE_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'comments-tinymce';

		$this->comment_tinymce_get_options[] = $this->comment_tinymce_get_options();
		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Comments_Tinymce_Loader. Orchestrates the hooks of the plugin.
	 * - Comments_Tinymce_i18n. Defines internationalization functionality.
	 * - Comments_Tinymce_Admin. Defines all hooks for the admin area.
	 * - Comments_Tinymce_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-comments-tinymce-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-comments-tinymce-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-comments-tinymce-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-comments-tinymce-public.php';

		$this->loader = new Comments_Tinymce_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Comments_Tinymce_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Comments_Tinymce_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Comments_Tinymce_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
        $this->loader->add_action( 'admin_menu', $plugin_admin, 'comment_tinymce_admin_menu' );
		$this->loader->add_action( 'admin_post_save_comment_tinymce_update_settings',$plugin_admin,'comment_tinymce_update_settings');
		$this->loader->add_filter( 'plugin_action_links_comment-tinymce/'.$this->plugin_name.'.php',$plugin_admin,'comment_tinymce_settings_link',10,1 );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Comments_Tinymce_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_filter('comment_form_defaults', $plugin_public, 'comment_tinymce_form_defaults', 20, 2); 
		$this->loader->add_action( 'init', $plugin_public, 'comment_tinymce_form_allowed_tags', 20 );
		$load_comment_tinymce = $this->comment_tinymce_get_options();
		$this->loader->add_filter('tiny_mce_before_init', $plugin_public, 'comment_tinymce_customize', 20, 2); 
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Comments_Tinymce_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	public static function comment_tinymce_get_options() {

		$options['comment_tinymce_heading_one'] = get_option( 'comment_tinymce_heading_one' );
		$options['comment_tinymce_heading_two'] = get_option( 'comment_tinymce_heading_two' );
		$options['comment_tinymce_heading_three'] = get_option( 'comment_tinymce_heading_three' );
		$options['comment_tinymce_heading_four'] = get_option( 'comment_tinymce_heading_four' );
		$options['comment_tinymce_heading_five'] = get_option( 'comment_tinymce_heading_five' );
		$options['comment_tinymce_heading_six'] = get_option( 'comment_tinymce_heading_six' );
		$options['comment_tinymce_media_btn'] = get_option( 'comment_tinymce_media_btn' );
		$options['comment_tinymce_pre_tag'] = get_option( 'comment_tinymce_pre_tag' );
		return $options;

	}

}
