<cms:php>
global $CTX, $FUNCS;

$user_activation_hash = sha1( uniqid( mt_rand(), true ) );
$user_password_hash = password_hash( $_POST['password'], PASSWORD_DEFAULT );

$CTX->set( 'activation_hash', $user_activation_hash );
$CTX->set( 'ip_address', trim( $FUNCS->cleanXSS( strip_tags( $_SERVER['REMOTE_ADDR'] ) ) ) );
$CTX->set( 'password_hash', $user_password_hash );
</cms:php>

<cms:db_persist
	_auto_title = '0'
	_invalidate_cache = '1'
	_masterpage = 'users.php'
	_mode = 'create'

	k_page_title = post_user_name

	user_activation_hash = activation_hash
	user_email = post_user_email
	user_name = post_user_name
	user_pw_hash = password_hash
	user_registration_ip = ip_address
>
	<cms:if k_error>
		<div class="alert alert-error">An unknown error occurred which prevented account creation.</div>
	<cms:else/>
		<cms:send_mail from=k_email_from to=post_user_email subject='Account Activation for Website Name'>Hello <cms:show post_user_name/>,

Please visit this link to activate your account: <cms:link 'register.php'/>?act=activate&amp;id=<cms:show k_last_insert_id/>&amp;hash=<cms:show activation_hash/>

Thanks,
Website Name</cms:send_mail>

		<cms:set register_success='1' scope='global'/>
	</cms:if>
</cms:db_persist>
