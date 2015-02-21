<?php
namespace SelvinOrtiz\Gossip;

interface Gossip
{
	/**
	 * Registers an callback as an event handler
	 *
	 * @param string   $event
	 * @param \Closure $handler
	 *
	 * @return mixed
	 */
	public function on($event, \Closure $handler) {}

	/**
	 * Registers an callback as an event handler that will remove itself after the first call
	 *
	 * @param string   $event
	 * @param \Closure $handler
	 *
	 * @return mixed
	 */
	public function once( $event, \Closure $handler ) {}

	/**
	 * Notifies the application about an event
	 *
	 * @param string $event
	 *
	 * @return mixed
	 */
	public function notify($event) {}
}
