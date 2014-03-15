<cms:php>
global $CTX;

$user_password_hash = password_hash( $_POST['new_password'], PASSWORD_DEFAULT );

$CTX->set( 'new_password_hash', $user_password_hash );
</cms:php>
