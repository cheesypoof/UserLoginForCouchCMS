<cms:php>
global $CTX, $FUNCS;

$user_cookie_name = 'couchcms_' . md5( K_SITE_URL . '_user_auth' );
$CTX->set( 'user_cookie_name', $user_cookie_name );

if ( isset( $_COOKIE[$user_cookie_name] ) ) {
	list( $id, $expiry, $hash ) = explode( ':', $_COOKIE[$user_cookie_name] );

	if ( $FUNCS->is_non_zero_natural( $expiry ) && time() < $expiry ) {
		if ( $FUNCS->is_non_zero_natural( $id ) && $hash == hash_hmac( 'sha256', $id . ':' . $expiry, USER_COOKIE_SECRET_KEY ) ) {
			$CTX->set( 'user_cookie_id', $id );
		} else {
			$CTX->set( 'user_cookie_invalid', 1 );
		}
	} else {
		$CTX->set( 'user_cookie_invalid', 1 );
	}
}
</cms:php>

<cms:if user_cookie_id>
	<cms:pages custom_field='user_active==1' id=user_cookie_id limit='1' masterpage='users.php' show_future_entries='1'>
		<cms:set authenticated='1' scope='global'/>

		<cms:show_securefile 'user_avatar'>
			<cms:if file_is_image>
				<cms:set my_user_avatar="<img src=\"<cms:cloak_url link=file_id thumbnail='1'/>\"/>" scope='global'/>
			</cms:if>
		</cms:show_securefile>

		<cms:if "<cms:not my_user_avatar/>">
			<cms:set my_user_avatar="<cms:gravatar email=user_email size='64'/>" scope='global'/>
		</cms:if>

		<cms:set my_user_email=user_email scope='global'/>
		<cms:set my_user_fname=user_fname scope='global'/>
		<cms:set my_user_id=k_page_id scope='global'/>
		<cms:set my_user_lname=user_lname scope='global'/>
		<cms:set my_user_name=user_name scope='global'/>
		<cms:set my_user_profile=k_page_link scope='global'/>

		<cms:no_results>
			<cms:delete_cookie user_cookie_name/>
		</cms:no_results>
	</cms:pages>
<cms:else/>
	<cms:if user_cookie_invalid>
		<cms:delete_cookie user_cookie_name/>
	</cms:if>
</cms:if>
