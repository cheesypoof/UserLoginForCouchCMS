<cms:if frm_user_name == user_name>
	<cms:set continue_user_name='1'/>
<cms:else/>
	<cms:set exists_user_name="<cms:pages count_only='1' custom_field="user_name==<cms:show frm_user_name/>" masterpage='users.php' show_future_entries='1'/>"/>

	<cms:if exists_user_name gt '0'>
		<div class="alert alert-error">We already have another account with that username.</div>
	<cms:else/>
		<cms:set new_user_name='1'/>
		<cms:set continue_user_name='1'/>
	</cms:if>
</cms:if>

<cms:if frm_email == user_email>
	<cms:set continue_email='1'/>
<cms:else/>
	<cms:set exists_user_email="<cms:pages count_only='1' custom_field="user_email==<cms:show frm_email/>" masterpage='users.php' show_future_entries='1'/>"/>

	<cms:if exists_user_email gt '0'>
		<div class="alert alert-error">We already have another account with that email address.</div>
	<cms:else/>
		<cms:set new_email='1'/>
		<cms:set continue_email='1'/>
	</cms:if>
</cms:if>
