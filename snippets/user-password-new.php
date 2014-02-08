<cms:php>
global $CTX;

$user_password_hash = password_hash( $_POST['new_password'], PASSWORD_DEFAULT, array( 'cost' => USER_PASSWORD_HASH_COST_FACTOR ) );

$CTX->set( 'new_password_hash', $user_password_hash );
</cms:php>
