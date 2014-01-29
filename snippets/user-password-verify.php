<cms:php>
global $CTX;

if ( password_verify( $_POST['password'], $CTX->get( 'user_pw_hash' ) ) )
	$CTX->set( 'password_verified', '1', 'local' );
</cms:php>
