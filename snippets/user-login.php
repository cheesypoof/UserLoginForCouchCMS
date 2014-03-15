<cms:db_persist
	_masterpage = 'users.php'
	_mode = 'edit'
	_page_id = k_page_id

	user_failed_logins = '0'
	user_last_failed_login_time = '0'
>
	<cms:if k_error>
		<div class="alert alert-error">An unknown error occurred which prevented authentication.</div>
	<cms:else/>
		<cms:if user_cookie_remember>
			<cms:set user_remember_expire="<cms:php>echo time() + 1209600;</cms:php>"/>
			<cms:set user_cookie_expire=user_remember_expire/>
		<cms:else/>
			<cms:set user_remember_expire="<cms:php>echo time() + 86400;</cms:php>"/>
			<cms:set user_cookie_expire='0'/>
		</cms:if>

		<cms:php>
		global $CTX;

		$cookie_data = $CTX->get( 'k_page_id' ) . ':' . $CTX->get( 'user_remember_expire' );
		$cookie_hash = hash_hmac( 'sha256', $cookie_data, USER_COOKIE_SECRET_KEY );
		$cookie_value = $cookie_data . ':' . $cookie_hash;

		$CTX->set( 'user_cookie_value', $cookie_value );
		</cms:php>

		<cms:set_cookie expire=user_cookie_expire name=user_cookie_name value=user_cookie_value/>

		<cms:set login_success='1' scope='global'/>
	</cms:if>
</cms:db_persist>
