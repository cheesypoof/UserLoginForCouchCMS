<cms:php>
global $CTX;

$CTX->set( 'password_reset_hash', sha1( uniqid( mt_rand(), true ) ) );
</cms:php>

<cms:db_persist
	_masterpage = 'users.php'
	_mode = 'edit'
	_page_id = k_page_id

	user_pw_reset_hash = password_reset_hash
	user_pw_reset_time = "<cms:date format='U'/>"
>
	<cms:if k_error>
		<div class="alert alert-error">
			<cms:each k_error>
				<cms:show item/><br/>
			</cms:each>
		</div>
	<cms:else/>
		<cms:send_mail from=k_email_from subject='Password Reset for Website Name' to=user_email>Hello <cms:show user_name/>,

		Please visit this link to reset your account password: <cms:link 'reset.php'/>?act=reset&amp;id=<cms:show k_page_id/>&amp;hash=<cms:show password_reset_hash/>

		Thanks,
		Website Name</cms:send_mail>

		<cms:set reset_success='1' scope='global'/>
	</cms:if>
</cms:db_persist>
