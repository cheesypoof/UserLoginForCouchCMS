<cms:php>
global $CTX, $FUNCS;

if ( defined( 'AUTHENTICATE' ) ) {
	$CTX->set( 'check_authentication', '1' );

	if ( AUTHENTICATE == 'session' ) {
		$CTX->set( 'authenticated', '1' );
	} else {
		list( $user_id, $token, $hash ) = explode( ':', $_COOKIE['remember'] );

		if ( $FUNCS->is_non_zero_natural( $user_id ) ) {
			$CTX->set( 'cookie_remember_id', $user_id );

			if ( !empty( $token ) && $hash == hash( 'sha256', $user_id . ':' . $token . USER_REMEMBER_COOKIE_SECRET_KEY ) )
				$CTX->set( 'cookie_remember_token', $token );
		}
	}
}
</cms:php>

<cms:if authenticated>
	<cms:pages id="<cms:get_session 'user_id'/>" limit='1' masterpage='users.php' show_future_entries='1'>
		<cms:embed 'user-init-set.php'/>

		<cms:no_results>
			<cms:set authenticated='0' scope='global'/>

			<cms:delete_cookie 'remember'/>

			<cms:delete_session 'user_id'/>
		</cms:no_results>
	</cms:pages>
<cms:else/>
	<cms:if check_authentication>
		<cms:if cookie_remember_id && cookie_remember_token>
			<cms:pages id=cookie_remember_id limit='1' masterpage='users.php' show_future_entries='1'>
				<cms:if user_remember_token != cookie_remember_token>
					<cms:delete_cookie 'remember'/>
				<cms:else/>
					<cms:embed 'user-init-login.php'/>

					<cms:embed 'user-init-set.php'/>

					<cms:set authenticated='1' scope='global'/>
				</cms:if>

				<cms:no_results>
					<cms:delete_cookie 'remember'/>
				</cms:no_results>
			</cms:pages>
		<cms:else/>
			<cms:if cookie_remember_id>
				<cms:db_persist
					_masterpage = 'users.php'
					_mode = 'edit'
					_page_id = cookie_remember_id

					user_remember_token = ''
				/>
			</cms:if>

			<cms:delete_cookie 'remember'/>
		</cms:if>
	</cms:if>
</cms:if>
