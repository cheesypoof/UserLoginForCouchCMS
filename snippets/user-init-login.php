<cms:embed 'user-remember.php'/>

<cms:set_cookie expire=remember_expire name='remember' value=remember_value/>

<cms:set_session name='user_id' value=k_page_id/>

<cms:db_persist
	_masterpage = 'users.php'
	_mode = 'edit'
	_page_id = k_page_id

	user_remember_token = remember_token
/>
