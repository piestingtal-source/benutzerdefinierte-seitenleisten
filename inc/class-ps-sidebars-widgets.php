<?php

add_action( 'cs_init', array( 'BenutzerdefinierteSeitenleistenWidgets', 'instance' ) );

/**
 * Extends the widgets section to add the custom sidebars UI elements.
 */
class BenutzerdefinierteSeitenleistenWidgets extends BenutzerdefinierteSeitenleisten {

	/**
	 * Returns the singleton object.
	 *
	 * @since  2.0
	 */
	public static function instance() {
		static $Inst = null;

		if ( null === $Inst ) {
			$Inst = new BenutzerdefinierteSeitenleistenWidgets();
		}

		return $Inst;
	}

	/**
	 * Constructor is private -> singleton.
	 *
	 * @since  2.0
	 */
	private function __construct() {
		if ( is_admin() ) {
			add_action(
				'widgets_admin_page',
				array( $this, 'widget_sidebar_content' )
			);

			add_action(
				'admin_head-widgets.php',
				array( $this, 'init_admin_head' )
			);
		}
		add_action( 'widgets_admin_page', array( $this, 'add_div_start' ) );
		add_action( 'sidebar_admin_page', array( $this, 'add_div_end' ) );
	}

	public function add_div_start() {
		echo '<div class="cs-wrap">';
	}

	public function add_div_end() {
		echo '</div>';
	}

	/**
	 * Adds the additional HTML code to the widgets section.
	 */
	public function widget_sidebar_content() {
		if ( false === self::$accessibility_mode ) {
			include CSB_VIEWS_DIR . 'widgets.php';
		}
	}

	/**
	 * Initialize the admin-head for the widgets page.
	 *
	 * @since  2.0.9.7
	 */
	public function init_admin_head( $classes ) {
		add_filter(
			'admin_body_class',
			array( $this, 'admin_body_class' )
		);
	}

	/**
	 * Add a class to the body tag.
	 *
	 * @since  2.0.9.7
	 */
	public function admin_body_class( $classes ) {
		$classes .= ' no-auto-init ';
		return $classes;
	}
};
