<?php require_once( 'couch/cms.php' ); ?>

<cms:template title='Account Settings'/>

<cms:embed 'user-init.php'/>

<cms:set get_activate="<cms:gpc method='get' var='activate'/>"/>
<cms:set get_logout="<cms:gpc method='get' var='logout'/>"/>

<cms:embed 'html-header.php'/>

<cms:if authenticated>
	<cms:if get_logout>
		<cms:embed 'user-logout.php'/>
	</cms:if>

	<cms:pages id=my_user_id limit='1' masterpage='users.php'>
		<h2>Information</h2>

		<cms:form anchor='0' action="<cms:link 'account.php'/>" masterpage='users.php' method='post' mode='edit' name='information' page_id=k_page_id>
			<cms:if k_success>
				<cms:embed 'user-edit-information.php'/>
			<cms:else/>
				<cms:if k_error>
					<div class="alert alert-error">
						<cms:each k_error>
							<cms:show item/><br/>
						</cms:each>
					</div>
				<cms:else/>
					<cms:get_flash 'information_success'/>
				</cms:if>
			</cms:if>

			<div><label for="f_user_fname">First Name</label></div>
			<div><cms:input name='user_fname' type='bound'/></div>

			<br/>

			<div><label for="f_user_lname">Last Name</label></div>
			<div><cms:input name='user_lname' type='bound'/></div>

			<br/>

			<input type="submit" value="Update Information"/>
		</cms:form>

		<br/>

		<h2>Account</h2>

		<cms:form anchor='0' action="<cms:link 'account.php'/>" method='post' name='account'>
			<cms:if k_success>
				<cms:embed 'user-password-verify.php'/>

				<cms:if "<cms:not password_verified/>">
					<div class="alert alert-error">Incorrect password. Please try again.</div>
				<cms:else/>
					<cms:embed 'user-exists.php'/>

					<cms:if continue_user_name && continue_email>
						<cms:if "<cms:not_empty frm_new_password/>" && "<cms:not_empty frm_new_password_repeat/>">
							<cms:embed 'user-password-new.php'/>
						</cms:if>

						<cms:if new_user_name || new_email || "<cms:not_empty new_password_hash/>">
							<cms:embed 'user-edit-account.php'/>
						<cms:else/>
							<div class="alert">You didn't enter any new account settings.</div>
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
				<cms:else/>
					<cms:get_flash 'account_success'/>
				</cms:if>
			</cms:if>

			<div><label for="password">Current Password (Required)</label></div>
			<div><input autocomplete="off" id="password" maxlength="64" name="password" pattern=".{8,64}" required="required" title="8 to 64 characters" type="password" value=""/></div>

			<cms:hide>
				<cms:input label='Current Password' name='password' required='1' type='password' val_separator=':' validator='min_len:8 | max_len:64 | regex:/^(?=.*[A-Z])(?=.*\d)([0-9a-zA-Z]+)$/' validator_msg='regex:Must contain at least one number and both lower and upper case letters.'/>
			</cms:hide>

			<br/>

			<div><label for="user_name">Username (Required)</label></div>
			<div><input id="user_name" maxlength="48" name="user_name" pattern="[a-zA-Z0-9]{3,48}" required="required" title="3 to 48 alphanumeric characters" type="text" value="<cms:show user_name/>"/></div>

			<cms:hide>
				<cms:input label='Username' name='user_name' required='1' type='text' validator='alpha_num | min_len=3 | max_len=48'/>
			</cms:hide>

			<br/>

			<div><label for="email">Email Address (Required)</label></div>
			<div><input id="email" name="email" required="required" type="email" value="<cms:show user_email/>"/></div>

			<cms:hide>
				<cms:input label='Email Address' name='email' required='1' type='text' validator='email'/>
			</cms:hide>

			<br/>

			<div><label for="new_password">New Password</label></div>
			<div><input autocomplete="off" id="new_password" maxlength="64" name="new_password" type="password" value=""/></div>

			<cms:hide>
				<cms:input label='New Password' name='new_password' type='password' val_separator=':' validator='min_len:8 | max_len:64 | regex:/^(?=.*[A-Z])(?=.*\d)([0-9a-zA-Z]+)$/ | matches_field:new_password_repeat' validator_msg='regex:Must contain at least one number and both lower and upper case letters.'/>
			</cms:hide>

			<br/>

			<div><label for="new_password_repeat">Repeat New Password</label></div>
			<div><input autocomplete="off" id="new_password_repeat" maxlength="64" name="new_password_repeat" type="password" value=""/></div>

			<cms:hide>
				<cms:input label='Repeat New Password' name='new_password_repeat' type='password'/>
			</cms:hide>

			<br/>

			<input type="submit" value="Update Account"/>
		</cms:form>
	</cms:pages>
<cms:else/>
	<cms:if "<cms:not get_activate/>">
		<cms:redirect k_site_link/>
	<cms:else/>
		<cms:embed 'user-action.php'/>

		<cms:set activation_fail_msg='<div class="alert alert-error">Account activation failed. Please check the URL for typos.</div>'/>

		<cms:if "<cms:not valid_id/>">
			<cms:show activation_fail_msg/>
		<cms:else/>
			<cms:pages id=get_id limit='1' masterpage='users.php'>
				<cms:if "<cms:not user_active/>" && get_hash == user_activation_hash>
					<cms:embed 'user-activate.php'/>
				<cms:else/>
					<cms:if user_active>
						<div class="alert alert-info">This account has already been successfully activated!</div>
					<cms:else/>
						<cms:show activation_fail_msg/>
					</cms:if>
				</cms:if>

				<cms:no_results>
					<cms:show activation_fail_msg/>
				</cms:no_results>
			</cms:pages>
		</cms:if>
	</cms:if>
</cms:if>

<?php COUCH::invoke(); ?>
