<?php

/*
 * User Login for CouchCMS (https://github.com/cheesypoof/UserLoginForCouchCMS)
 * Copyright (c) 2014 Increment Web Services (http://incrementwebservices.com/)
 * Released under the MIT License (https://github.com/cheesypoof/UserLoginForCouchCMS/blob/master/LICENSE)
 */

if ( !defined( 'K_ADMIN' ) ) {
	require_once( K_COUCH_DIR . '/addons/password-compatibility.php' );

	// Password hashing strength
	// Leave this alone
	define( 'USER_PASSWORD_HASH_COST_FACTOR', '10' );

	// Life of remember cookies
	// 2 weeks in seconds
	define( 'USER_REMEMBER_COOKIE_EXPIRE', 1209600 );

	// Enter a random value to make your remember cookies more secure
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
