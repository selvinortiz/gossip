<?php
namespace SelvinOrtiz\Gossip;

/**
 * Class Gossip
 *
 * @author  Selvin Ortiz - http://selv.in
 * @package SelvinOrtiz\Gossip
 * @version 0.2.0
 */
class Gossip
{
	/**
	 * @var \Closure[]
	 */
	protected $handlers = array();

	/**
	 * @inheritDoc IGossip::on()
	 */
	public function on($event, \Closure $handler)
	{
		if (!array_key_exists($event, $this->handlers))
		{
			$this->handlers[$event] = array();
		}

		$this->handlers[$event][] = $handler;
	}

	/**
	 * @inheritDoc IGossip::once()
	 */
	public function once($event, \Closure $handler) {}

	/**
	 * @inheritDoc IGossip::notify()
	 */
	public function notify($event, array $params = array())
	{
		$args  = func_get_args();
		$event = array_shift( $args );

		foreach ($this->getEventHandlers($event) as $handler)
		{
			call_user_func_array($handler, $args);
		}
	}

	/**
	 * Returns all the registered handlers for a given event
	 *
	 * @param \Closure[]
	 */
	protected function getEventHandlers($event)
	{
		return array_key_exists($event, $this->handlers) ? $this->handlers[$event] : array();
	}
}
