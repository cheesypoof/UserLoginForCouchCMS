<cms:db_persist
	_invalidate_cache = '1'
	_masterpage = 'users.php'
	_mode = 'edit'
	_page_id = k_page_id

	user_activation_hash = ''
	user_active = '1'
>
	<cms:if k_error>
		<cms:show activation_fail_msg/>
	<cms:else/>
		<div class="alert alert-success">Your account has been successfully activated! You can now log in.</div>
	</cms:if>
</cms:db_persist>
