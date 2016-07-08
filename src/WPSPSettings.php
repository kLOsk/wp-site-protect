<?php

namespace mowta\SiteProtect;


class WPSPSettings {
	
	public static $prefix = "wpsp_";

	/**
	 * Returns true if WP Site Protect is globally enabled.
	 *
	 * If the option isn't set, it will always return true.
	 *
	 * @return bool
	 */
	public static function enabled() {
		return get_option( self::$prefix . 'enabled' ) == 'yes';
	}

	/**
	 * Returns the minimum password strength for a valid password.
	 *
	 * @return string
	 */
	public static function get_password_strength() {
		return get_option( self::$prefix . 'password_strength' ) ? get_option( 'wpsp_password_strength' ) : 'strong';
	}

	/**
	 * @param bool $raw return the raw information
	 *
	 * @return array|string
	 */
	public static function get_blacklist( $raw = false ) {
		$blacklist = get_option( self::$prefix . 'blacklist' );
		if( $raw ) {
			return $blacklist ? $blacklist : "password\nqwerty\nwordpress\n123456";
		}

		if ( ! $blacklist ) {
			$blacklist = "password\nqwerty\nwordpress\n123456";
		}

		return explode("\n", $blacklist);

	}

	public static function get_password_content( ) {
		$content = get_option( self::$prefix . 'password_content' );
		if ( ! $content ) {
			return __( '<h2>Access Restricted</h2>', 'wp-site-protect') .
				__( '<p>You need to insert your password in order to continue.</p>', 'wp-site-protect' );
		}
	}

	public static function get_reset_content( ) {
		$content = get_option( self::$prefix . 'reset_content' );
		if ( ! $content ) {
			return __( '<h2>Reset password</h2>', 'wp-site-protect') .
			       __( '<p>Before you continue, you must reset the password to something different. Please use a good strong password.</p>', 'wp-site-protect' );
		}
	}

}