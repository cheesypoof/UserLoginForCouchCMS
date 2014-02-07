<?php require_once( 'couch/cms.php' ); ?>

<cms:template title='Reset Password'/>

<cms:embed 'user-init.php'/>

<cms:set get_reset="<cms:gpc method='get' var='reset'/>"/>

<cms:embed 'html-header.php'/>

<h2>Reset Password</h2>

<cms:if authenticated>
	<div class="alert alert-info">You are currently logged in.</div>
<cms:else/>
	<cms:if get_reset>
		<cms:embed 'user-action.php'/>

		<cms:set reset_fail_msg='<div class="alert alert-error">Password reset failed. Please check the URL for typos.</div>'/>

		<cms:if "<cms:not valid_id/>">
			<cms:show reset_fail_msg/>
		<cms:else/>
			<cms:pages id=get_id limit='1' masterpage='users.php'>
				<cms:if "<cms:not user_pw_reset_hash/>" || get_hash != user_pw_reset_hash>
					<cms:show reset_fail_msg/>
				<cms:else/>
					<cms:if user_pw_reset_time lt "<cms:sub "<cms:date format='U'/>" '3600'/>">
						<div class="alert">This password reset link has expired. Please request new instructions.</div>
					<cms:else/>
						<cms:embed 'user-password-temporary.php'/>
					</cms:if>
				</cms:if>

				<cms:no_results>
					<cms:show reset_fail_msg/>
				</cms:no_results>
			</cms:pages>
		</cms:if>
	<cms:else/>
		<cms:form anchor='0' action=k_template_link method='post' name='reset'>
			<cms:if k_success>
				<cms:pages custom_field="user_name==<cms:show frm_user_name/>" limit='1' masterpage='users.php'>
					<cms:embed 'user-password-reset.php'/>

					<cms:no_results>
						<div class="alert alert-error">We have no record of that username.</div>
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

			<cms:if reset_success>
				<div class="alert alert-success">Please check your email inbox for further instructions.</div>
			<cms:else/>
				<div><label for="user_name">Username</label></div>
				<div><input autofocus="autofocus" id="user_name" maxlength="48" name="user_name" pattern="[a-zA-Z0-9]{3,48}" required="required" title="3 to 48 alphanumeric characters" type="text" value="<cms:gpc method='post' var='user_name'/>"/></div>

				<cms:hide>
					<cms:input label='Username' name='user_name' required='1' type='text' validator='alpha_num | min_len=3 | max_len=48'/>
				</cms:hide>

				<br/>

				<input type="submit" value="Send Instructions"/>
			</cms:if>
		</cms:form>
	</cms:if>
</cms:if>

<?php COUCH::invoke(); ?>
