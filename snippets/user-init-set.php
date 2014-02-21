<cms:show_securefile 'user_avatar'>
	<cms:if file_is_image>
		<cms:set my_user_avatar="<img src=\"<cms:cloak_url link=file_id thumbnail='1'/>\"/>" scope='global'/>
	</cms:if>
</cms:show_securefile>

<cms:if "<cms:not my_user_avatar/>">
	<cms:set my_user_avatar="<cms:gravatar email=user_email size='64'/>" scope='global'/>
</cms:if>

<cms:set my_user_email=user_email scope='global'/>
<cms:set my_user_fname=user_fname scope='global'/>
<cms:set my_user_id=k_page_id scope='global'/>
<cms:set my_user_lname=user_lname scope='global'/>
<cms:set my_user_name=user_name scope='global'/>
<cms:set my_user_profile=k_page_link scope='global'/>
