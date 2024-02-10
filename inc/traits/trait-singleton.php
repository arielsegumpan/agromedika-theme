<?php

namespace HERBANEXT_THEME\Inc\Traits;

trait Singleton {


	protected function __construct() {
	}

	final protected function __clone() {
	}

	/**
	 *
	 * @return object Singleton instance of the class.
	 */
	final public static function get_instance() {

		/**
		 * Collection of instance.
		 *
		 * @var array
		 */
		static $instance = [];

		$called_class = get_called_class();

		if ( ! isset( $instance[ $called_class ] ) ) {

			$instance[ $called_class ] = new $called_class();

			/**
			 * Dependent items can use the `herbanext_theme_singleton_init_{$called_class}` hook to execute code
			 */
			do_action( sprintf( 'herbanext_theme_singleton_init%s', $called_class ) ); // phpcs:ignore WordPress.NamingConventions.ValidHookName.UseUnderscores

		}

		return $instance[ $called_class ];

	}

} 