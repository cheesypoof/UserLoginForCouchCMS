<cms:php>
global $CTX;

$random_token = hash( 'sha256', mt_rand() );

$cookie_string_part = $CTX->get( 'k_page_id' ) . ':' . $random_token;
$cookie_string_hash = hash( 'sha256', $cookie_string_part . USER_REMEMBER_COOKIE_SECRET_KEY );
$cookie_string = $cookie_string_part . ':' . $cookie_string_hash;

$CTX->set( 'remember_expire', USER_REMEMBER_COOKIE_EXPIRE );
$CTX->set( 'remember_token', $random_token );
$CTX->set( 'remember_value', $cookie_string );
</cms:php>
