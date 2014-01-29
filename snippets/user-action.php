<cms:set get_id="<cms:gpc method='get' var='id'/>"/>
<cms:set get_hash="<cms:gpc method='get' var='hash'/>"/>

<cms:php>
global $CTX, $FUNCS;

if ( $FUNCS->is_non_zero_natural( $CTX->get( 'get_id' ) ) )
	$CTX->set( 'valid_id', '1', 'local' );
</cms:php>
