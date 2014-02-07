<?php require_once( 'couch/cms.php' ); ?>

<cms:template title='Register'/>

<cms:embed 'user-init.php'/>

<cms:embed 'html-header.php'/>

<h2>Register</h2>

<cms:if authenticated>
	<div class="alert alert-info">You are currently logged in.</div>
<cms:else/>
	<cms:form anchor='0' action=k_template_link anchor='0' masterpage='users.php' method='post' mode='create' name='register'>
		<cms:if k_submitted>
			<cms:set post_user_email="<cms:gpc method='post' var='f_user_email'/>"/>
			<cms:set post_user_name="<cms:gpc method='post' var='f_user_name'/>"/>
		</cms:if>

		<cms:if k_success>
			<cms:if "<cms:not "<cms:gpc method='post' var='agree'/>"/>">
				<div class="alert">You must agree to our Terms and Privacy Policy to continue.</div>
			<cms:else/>
				<cms:set exists_user_name="<cms:pages count_only='1' custom_field="user_name==<cms:show post_user_name/>" masterpage='users.php'/>"/>

				<cms:if exists_user_name gt '0'>
					<div class="alert">An account with that username already exists.</div>
				<cms:else/>
					<cms:set exists_user_email="<cms:pages count_only='1' custom_field="user_email==<cms:show post_user_email/>" masterpage='users.php'/>"/>

					<cms:if exists_user_email gt '0'>
						<div class="alert">An account with that email address already exists.</div>
					<cms:else/>
						<cms:embed 'user-register.php'/>
					</cms:if>
				</cms:if>
			</cms:if>
		<cms:else/>
			<cms:if k_error>
				<div class="alert alert-error">
					<cms:each k_error>
						<cms:show item/><br/>
					</cms:each>
				</div>
			</cms:if>
		</cms:if>

		<cms:if register_success>
			<div class="alert alert-success">Your account has been successfully created! Please check your email inbox for an activation link.</div>
		<cms:else/>
			<div><label for="user_name">Username</label></div>
			<div><input autofocus="autofocus" id="user_name" maxlength="48" name="f_user_name" pattern="[a-zA-Z0-9]{3,48}" required="required" title="3 to 48 alphanumeric characters" type="text" value="<cms:show post_user_name/>"/></div>

			<cms:hide>
				<cms:input label='Username' name='user_name' type='bound'/>
			</cms:hide>

			<br/>

			<div><label for="email">Email Address</label></div>
			<div><input id="email" name="f_user_email" required="required" type="email" value="<cms:show post_user_email/>"/></div>

			<cms:hide>
				<cms:input label='Email Address' name='user_email' type='bound'/>
			</cms:hide>

			<br/>

			<div><label for="password">Password</label></div>
			<div><input autocomplete="off" id="password" maxlength="64" name="password" pattern=".{8,64}" required="required" title="8 to 64 characters" type="password" value=""/></div>

			<cms:hide>
				<cms:input label='Password' name='password' required='1' type='password' val_separator=':' validator='min_len:8 | max_len:64 | regex:/^(?=.*[A-Z])(?=.*\d)([0-9a-zA-Z]+)$/ | matches_field:password_repeat' validator_msg='regex:Must contain at least one number and both lower and upper case letters.'/>
			</cms:hide>

			<br/>

			<div><label for="password_repeat">Repeat Password</label></div>
			<div><input autocomplete="off" id="password_repeat" maxlength="64" name="password_repeat" pattern=".{8,64}" required="required" title="8 to 64 characters" type="password" value=""/></div>

			<cms:hide>
				<cms:input label='Repeat Password' name='password_repeat' required='1' type='password'/>
			</cms:hide>

			<br/>

			<div><label for="agree"><input id="agree" name="agree" required="required" type="checkbox" value="1"/>I agree to the <a href="" target="_blank">Terms</a> and <a href="" target="_blank">Privacy Policy</a></label></div>

			<br/>

			<input type="submit" value="Register"/>
		</cms:if>
	</cms:form>
</cms:if>

<?php COUCH::invoke(); ?>
