<?php require_once( 'couch/cms.php' ); ?>

<cms:template title='Reset Password'/>

<cms:embed 'user-init.php'/>

<cms:set get_hash="<cms:gpc method='get' var='hash'/>"/>

<cms:embed 'html-header.php'/>

<h2>Reset Password</h2>

<cms:if authenticated>
	<div class="alert alert-info">You are currently logged in.</div>
<cms:else/>
	<cms:if get_hash>
		<cms:embed 'user-action.php'/>

		<cms:set reset_fail_msg='<div class="alert alert-error">Password reset failed. Please check the URL for typos.</div>'/>

		<cms:if "<cms:not valid_id/>">
			<cms:show reset_fail_msg/>
		<cms:else/>
			<cms:pages id=get_id limit='1' masterpage='users.php' show_future_entries='1'>
				<cms:if "<cms:not user_pw_reset_hash/>" || get_hash != user_pw_reset_hash>
					<cms:show reset_fail_msg/>
				<cms:else/>
					<cms:if user_pw_reset_time lt "<cms:sub "<cms:date format='U'/>" '1800'/>">
						<div class="alert">This password reset link has expired. Please request new instructions.</div>
					<cms:else/>
						<cms:form action="<cms:concat "<cms:link 'reset.php'/>" '?id=' k_page_id '&amp;hash=' user_pw_reset_hash/>" anchor='0' method='post' name='change'>
							<cms:if k_success>
								<cms:embed 'user-password-change.php'/>
							<cms:else/>
								<cms:if k_error>
									<div class="alert alert-error">
										<cms:each k_error>
											<cms:show item/><br/>
										</cms:each>
									</div>
								</cms:if>
							</cms:if>

							<cms:if change_success>
								<div class="alert alert-success">Your account password has been successfully changed!</div>
							<cms:else/>
								<div><label for="new_password">New Password</label></div>
								<div><input autocomplete="off" autofocus="autofocus" id="new_password" maxlength="64" name="new_password" pattern=".{8,64}" required="required" title="8 to 64 characters" type="password" value=""/></div>

								<cms:hide>
									<cms:input label='New Password' name='new_password' required='1' type='password' val_separator=':' validator='min_len:8 | max_len:64 | regex:/^(?=.*[A-Z])(?=.*\d)([0-9a-zA-Z]+)$/ | matches_field:new_password_repeat' validator_msg='regex:Must contain at least one number and both lower and upper case letters.'/>
								</cms:hide>

								<br/>

								<div><label for="new_password_repeat">Repeat New Password</label></div>
								<div><input autocomplete="off" id="new_password_repeat" maxlength="64" name="new_password_repeat" pattern=".{8,64}" required="required" title="8 to 64 characters" type="password" value=""/></div>

								<cms:hide>
									<cms:input label='Repeat New Password' name='new_password_repeat' required='1' type='password'/>
								</cms:hide>

								<br/>

								<input type="submit" value="Change Password"/>
							</cms:if>
						</cms:form>
					</cms:if>
				</cms:if>

				<cms:no_results>
					<cms:show reset_fail_msg/>
				</cms:no_results>
			</cms:pages>
		</cms:if>
	<cms:else/>
		<cms:form action=k_template_link anchor='0' method='post' name='reset'>
			<cms:if k_success>
				<cms:pages custom_field="user_email==<cms:show frm_user_email/>" limit='1' masterpage='users.php' show_future_entries='1'>
					<cms:if user_pw_reset_time gt "<cms:sub "<cms:date format='U'/>" '300'/>">
						<div class="alert">Please wait a few minutes before requesting new instructions.</div>
					<cms:else/>
						<cms:embed 'user-password-reset.php'/>
					</cms:if>

					<cms:no_results>
						<div class="alert alert-error">We have no record of that email address.</div>
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
				<div><label for="user_email">Email Address</label></div>
				<div><input autofocus="autofocus" id="user_email" name="user_email" required="required" type="email" value="<cms:gpc method='post' var='user_email'/>"/></div>

				<cms:hide>
					<cms:input label='Email Address' name='user_email' required='1' type='text' validator='email'/>
				</cms:hide>

				<br/>

				<input type="submit" value="Send Instructions"/>
			</cms:if>
		</cms:form>
	</cms:if>
</cms:if>

<?php COUCH::invoke(); ?>
