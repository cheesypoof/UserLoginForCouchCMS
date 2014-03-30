<cms:db_persist
	_invalidate_cache = '1'
	_masterpage = 'users.php'
	_mode = 'edit'
	_page_id = k_page_id

	k_page_name = ''
	k_page_title = frm_user_name

	user_email = frm_email
	user_name = frm_user_name
	user_pw_hash = "<cms:if "<cms:not_empty new_password_hash/>"><cms:show new_password_hash/><cms:else/><cms:show user_pw_hash/></cms:if>"
>
	<cms:if k_error>
		<div class="alert alert-error">
			<cms:each k_error>
				<cms:show item/><br/>
			</cms:each>
		</div>
	<cms:else/>
		<cms:set_flash name='account_success' value='1'/>

		<cms:redirect "<cms:link 'account.php'/>"/>
	</cms:if>
</cms:db_persist>
