<cms:set csrf_token="<cms:get_session 'user_csrf_token'/>"/>

<cms:if "<cms:not csrf_token/>">
	<cms:set csrf_token="<cms:php>echo sha1( uniqid( mt_rand(), true ) );</cms:php>"/>

	<cms:set_session name='user_csrf_token' value=csrf_token/>
</cms:if>
