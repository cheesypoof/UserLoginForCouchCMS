<cms:db_persist
	_masterpage = 'users.php'
	_mode = 'edit'
	_page_id = "<cms:get_session 'user_id'/>"

	user_remember_token = ''
/>

<cms:delete_cookie 'remember'/>

<cms:delete_session name='user_id'/>

<cms:redirect "<cms:link 'login.php'/>"/>
