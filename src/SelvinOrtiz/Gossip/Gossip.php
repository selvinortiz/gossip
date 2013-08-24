<?php
namespace SelvinOrtiz\Gossip;

class Gossip
{
	protected $handlers = array();

	public function on( $event, \Closure $handler )
	{
		if ( ! array_key_exists( (string) $event, $this->handlers ) ) {
			$this->handlers[ (string) $event ] = array();
		}

		$this->handlers[ (string) $event ][] = $handler;
	}

	public function once( $event, \Closure $handler ) {}

	public function notify( $event )
	{
		$args = func_get_args();
		$event= array_shift( $args );

		foreach ( $this->getEventHandlers( $event ) as $handler ) {
			$this->execute( $event, $handler, $args );
		}
	}

	public function getEventHandlers( $event )
	{
		return array_key_exists( (string) $event, $this->handlers ) ? $this->handlers[ (string) $event ] : array();
	}

	protected function execute( $event, $handler, $args=array() )
	{
		$count = count( $args );

		if ( is_array( $args ) && $count ) {
			switch( $count ) {
				case 1:
					return $handler->__invoke( $event, $args[ 0 ] );
				break;
				case 2:
					return $handler->__invoke( $event, $args[ 0 ], $args[ 1 ] );
				break;
				case 3:
					return $handler->__invoke( $event, $args[ 0 ], $args[ 1 ], $args[ 2 ] );
				break;
				case 4:
					return $handler->__invoke( $event, $args[ 0 ], $args[ 1 ], $args[ 2 ], $args[ 3 ] );
				break;
				case 5:
					return $handler->__invoke( $event, $args[ 0 ], $args[ 1 ], $args[ 2 ], $args[ 3 ], $args[ 4 ] );
				break;
				default:
					return $handler->__invoke( $event, $args );
				break;
			}
		}

		return $handler->__invoke( $event );
	}

}
