<?php

// User Login for CouchCMS
// Add this to the end of your config.php file
if ( !defined( 'K_ADMIN' ) ) {
	require_once( K_COUCH_DIR . '/addons/password-compatibility.php' );

	// Password hashing strength
	// Leave this alone
	define( 'USER_PASSWORD_HASH_COST_FACTOR', '10' );

	// Life of the remember cookie
	// 2 weeks in seconds
	define( 'USER_REMEMBER_COOKIE_EXPIRE', 1209600 );

	// Enter a random value to make your remember cookie more secure
	// Changing this invalidates all remember cookies
	define( 'USER_REMEMBER_COOKIE_SECRET_KEY', '3]UbHj!Q=E?cNN}B(@P,&x(t' );

	// Start session
	if ( !session_id() )
		@session_start();

	// Check if visitor is logged in or trying to log in with remember cookie
	if ( isset( $_SESSION['user_id'] ) || isset( $_COOKIE['remember'] ) ) {
		define( 'AUTHENTICATE', isset( $_SESSION['user_id'] ) ? 'session' : 'cookie' );

		// Prevent Couch caching
		$_GET['nc'] = 1;
	}
}
