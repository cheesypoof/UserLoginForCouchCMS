<?php

/*
 * User Login for CouchCMS (https://github.com/cheesypoof/UserLoginForCouchCMS)
 * Copyright (c) 2015. Released under the MIT License.
 */

if ( !defined( 'K_ADMIN' ) ) {
	require_once( K_COUCH_DIR . '/addons/password-compatibility.php' );

	// Enter a long random value to make your login implementation more secure
	// Changing this invalidates all user cookies
	define( 'USER_COOKIE_SECRET_KEY', 'RMmwMmcyhTixflw8PPBCNQaBpR6dO2FvGgn2je5p3nfntdEenz66C5J8t1rq1gY1' );
}
