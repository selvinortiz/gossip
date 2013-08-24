<?php
namespace SelvinOrtiz\Gossip;

interface Gossip
{
	# Register an event handler
	public function on( $event, \Closure $handler ) {}

	# Register an event handler that will remove itself after the first call
	public function once( $event, \Closure $handler ) {}

	# Notify that an event has been completed
	public function notify( $event ) {}
}
