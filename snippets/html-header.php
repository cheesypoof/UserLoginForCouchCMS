<p>Hello
	<cms:if authenticated>
		<cms:if my_user_fname>
			<cms:show my_user_fname/> <cms:show my_user_lname/> (<cms:show my_user_name/>)
		<cms:else/>
			<cms:show my_user_name/>
		</cms:if>
	<cms:else/>
		stranger
	</cms:if>
</p>

<p>
	<a href="<cms:link 'users.php'/>">Users</a>

	<cms:if authenticated>
		- <a href="<cms:link 'account.php'/>">Account Settings</a>
		- <a href="<cms:show my_user_profile/>">Profile</a>
		- <a href="<cms:link 'account.php'/>?logout=1">Log Out</a>
	<cms:else/>
		- <a href="<cms:link 'register.php'/>">Register</a>
		- <a href="<cms:link 'login.php'/>">Log In</a>
		- <a href="<cms:link 'reset.php'/>">Reset Password</a>
	</cms:if>
</p>
