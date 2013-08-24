<?php
require __DIR__.'/../vendor/autoload.php';

$gossip = new \SelvinOrtiz\Gossip\Gossip();

$gossip->on( 'cartChange', function( $event, $time ) {
	echo '<pre style="color: #d00; font-weight: bold;">';
	echo "The $event event was just executed @ $time";
	echo '</pre>';
});

$gossip->notify( 'cartChange', time() );
