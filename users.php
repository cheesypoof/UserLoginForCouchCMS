<?php require_once( 'couch/cms.php' ); ?>

<cms:template clonable='1' title='Users'>
	<cms:editable label='Information' name='user_info_group' order='5' type='group'/>
		<cms:editable group='user_info_group' label='Name' name='user_name' order='5' required='1' type='text' validator='alpha_num | min_len=3 | max_len=48'/>
		<cms:editable group='user_info_group' label='Email Address' name='user_email' order='10' required='1' type='text' validator='email'/>

		<cms:editable group='user_info_group' label='First Name' name='user_fname' order='15' type='text'/>
		<cms:editable group='user_info_group' label='Last Name' name='user_lname' order='20' type='text'/>

		<cms:editable allowed_ext='gif, jpg, png' crop='1' group='user_info_group' height='256' label='Avatar' max_size='1024' name='user_avatar' order='25' show_preview='1' thumb_height='64' thumb_width='64' type='securefile' use_thumb_for_preview='0' width='256'/>

	<cms:editable desc='Don\'t Edit' label='System' name='user_system_group' order='10' type='group'/>
		<cms:editable group='user_system_group' label='Active' name='user_active' opt_selected='0' opt_values='Yes=1 | | No=0' order='5' type='radio'/>
		<cms:editable group='user_system_group' label='Activation Hash' name='user_activation_hash' order='10' type='text'/>

		<cms:editable group='user_system_group' label='Password Hash' name='user_pw_hash' order='15' required='1' type='text'/>

		<cms:editable group='user_system_group' label='Password Reset Hash' name='user_pw_reset_hash' order='20' type='text'/>
		<cms:editable group='user_system_group' label='Password Reset Time' name='user_pw_reset_time' order='25' search_type='integer' type='text' validator='non_negative_integer'>0</cms:editable>

		<cms:editable group='user_system_group' label='Remember Token' name='user_remember_token' order='30' type='text'/>

		<cms:editable group='user_system_group' label='Failed Logins' name='user_failed_logins' order='35' search_type='integer' type='text' validator='non_negative_integer'>0</cms:editable>
		<cms:editable group='user_system_group' label='Last Failed Login Time' name='user_last_failed_login_time' order='40' search_type='integer' type='text' validator='non_negative_integer'>0</cms:editable>

		<cms:editable group='user_system_group' label='Registration IP Address' name='user_registration_ip' order='45' type='text'/>
</cms:template>

<cms:embed 'user-init.php'/>

<cms:embed 'html-header.php'/>

<cms:if k_is_page>
	<cms:if "<cms:not user_active/>">
		<cms:redirect k_template_link/>
	</cms:if>

	<h2><cms:show user_name/></h2>

	<ul>
		<cms:show_securefile 'user_avatar'>
			<cms:if file_is_image>
				<cms:set current_user_avatar="<img src=\"<cms:cloak_url file_id/>\"/>" scope='global'/>
			</cms:if>
		</cms:show_securefile>

		<li>
			<cms:if current_user_avatar>
				<cms:show current_user_avatar/>
			<cms:else/>
				<cms:gravatar email=user_email size='256'/>
			</cms:if>
		</li>

		<li><strong>Registered:</strong> <cms:date k_page_date format='F j, Y'/></li>

		<li><strong>Email Address:</strong> <cms:show user_email/></li>

		<cms:if user_fname>
			<li><strong>First Name:</strong> <cms:show user_fname/></li>
		</cms:if>

		<cms:if user_lname>
			<li><strong>Last Name:</strong> <cms:show user_lname/></li>
		</cms:if>
	</ul>
<cms:else/>
	<cms:pages custom_field='user_active==1'>
		<h2><a href="<cms:show k_page_link/>"><cms:show user_name/></a></h2>

		<ul>
			<cms:show_securefile 'user_avatar'>
				<cms:if file_is_image>
					<cms:set current_user_avatar="<img src=\"<cms:cloak_url link=file_id thumbnail='1'/>\"/>" scope='global'/>
				</cms:if>
			</cms:show_securefile>

			<li>
				<cms:if current_user_avatar>
					<cms:show current_user_avatar/>
				<cms:else/>
					<cms:gravatar email=user_email size='64'/>
				</cms:if>
			</li>

			<li><strong>Registered:</strong> <cms:date k_page_date format='F j, Y'/></li>

			<li><strong>Email Address:</strong> <cms:show user_email/></li>

			<cms:if user_fname>
				<li><strong>First Name:</strong> <cms:show user_fname/></li>
			</cms:if>

			<cms:if user_lname>
				<li><strong>Last Name:</strong> <cms:show user_lname/></li>
			</cms:if>
		</ul>
	</cms:pages>
</cms:if>

<?php COUCH::invoke(); ?>
