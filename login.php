<?php require_once( 'couch/cms.php' ); ?>

<cms:template title='Login'/>

<cms:embed 'user-init.php'/>

<cms:embed 'html-header.php'/>

<h2>Login</h2>

<cms:if authenticated>
	<div class="alert alert-info">You are currently logged in.</div>
<cms:else/>
	<cms:form anchor='0' action=k_template_link method='post' name='login'>
		<cms:if k_success>
			<cms:set login_fail_msg='<div class="alert alert-error">Incorrect login credentials. Please try again.</div>'/>

			<cms:pages custom_field="user_name==<cms:show frm_user_name/>" limit='1' masterpage='users.php'>
				<cms:if user_failed_logins ge '3' && user_last_failed_login_time gt "<cms:sub "<cms:date format='U'/>" '20'/>">
					<div class="alert">You have entered incorrect login credentials 3 or more times. Please wait 20 seconds to try again.</div>
				<cms:else/>
					<cms:embed 'user-password-verify.php'/>

					<cms:if "<cms:not password_verified/>">
						<cms:show login_fail_msg/>

						<cms:embed 'user-login-fail.php'/>
					<cms:else/>
						<cms:if "<cms:not user_active/>">
							<div class="alert">This account has not been activated. Please check your email inbox for instructions.</div>
						<cms:else/>
							<cms:if "<cms:gpc method='post' var='remember'/>">
								<cms:embed 'user-login-remember.php'/>
							<cms:else/>
								<cms:embed 'user-login.php'/>
							</cms:if>

							<cms:redirect "<cms:link 'account.php'/>"/>
						</cms:if>
					</cms:if>
				</cms:if>

				<cms:no_results>
					<cms:show login_fail_msg/>
				</cms:no_results>
			</cms:pages>
		<cms:else/>
			<cms:if k_error>
				<div class="alert alert-error">
					<cms:each k_error>
						<cms:show item/><br/>
					</cms:each>
				</div>
			</cms:if>
		</cms:if>

		<div><label for="user_name">Username</label></div>
		<div><input autofocus="autofocus" id="user_name" maxlength="48" name="user_name" pattern="[a-zA-Z0-9]{3,48}" required="required" title="3 to 48 alphanumeric characters" type="text" value="<cms:gpc method='post' var='user_name'/>"/></div>

		<cms:hide>
			<cms:input label='Username' name='user_name' required='1' type='text' validator='alpha_num | min_len=3 | max_len=48'/>
		</cms:hide>

		<br/>

		<div><label for="password">Password</label></div>
		<div><input id="password" maxlength="64" name="password" pattern=".{6,64}" required="required" title="6 to 64 characters" type="password" value=""/></div>

		<cms:hide>
			<cms:input label='Password' name='password' required='1' type='password' validator='min_len=6 | max_len=64'/>
		</cms:hide>

		<br/>

		<div><label for="remember"><input id="remember" name="remember" type="checkbox" value="1"/>Keep me logged in</label></div>

		<br/>

		<input type="submit" value="Log In"/>
	</cms:form>
</cms:if>

<?php COUCH::invoke(); ?>
