<cms:no_cache/>

<cms:set get_id="<cms:gpc method='get' var='id'/>"/>

<cms:php>
global $CTX, $FUNCS;

if ( $FUNCS->is_non_zero_natural( $CTX->get( 'get_id' ) ) )
	$CTX->set( 'valid_id', '1' );
</cms:php>
