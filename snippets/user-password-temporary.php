<cms:php>
global $CTX;

$user_temporary_password = sha1( uniqid( mt_rand(), true ) );
$user_temporary_password_hash = password_hash( $user_temporary_password, PASSWORD_DEFAULT, array( 'cost' => USER_PASSWORD_HASH_COST_FACTOR ) );

$CTX->set( 'temporary_password', $user_temporary_password, 'local' );
$CTX->set( 'temporary_password_hash', $user_temporary_password_hash, 'local' );
</cms:php>

<cms:db_persist
	_masterpage = 'users.php'
	_mode = 'edit'
	_page_id = k_page_id

	user_pw_hash = temporary_password_hash
	user_pw_reset_hash = ''
	user_pw_reset_time = '0'
/>

<cms:send_mail from=k_email_from to=user_email subject='Temporary Password for Website Name'>Hello <cms:show user_name/>,

Your new account password is: <cms:show temporary_password/>

We recommend that you update this on the 'Account Settings' page after logging in.

Thanks,
Website Name</cms:send_mail>

<div class="alert alert-success">Please check your email inbox for a temporary password.</div>
