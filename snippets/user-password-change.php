<cms:embed 'user-password-new.php'/>

<cms:db_persist
	_masterpage = 'users.php'
	_mode = 'edit'
	_page_id = k_page_id

	user_pw_hash = new_password_hash
	user_pw_reset_hash = ''
	user_pw_reset_time = '0'
/>

<cms:set change_success='1' scope='global'/>
