<cms:db_persist
	_masterpage = 'users.php'
	_mode = 'edit'
	_page_id = k_page_id

	user_failed_logins = "<cms:add user_failed_logins '1'/>"
	user_last_failed_login_time = "<cms:date format='U'/>"
/>
