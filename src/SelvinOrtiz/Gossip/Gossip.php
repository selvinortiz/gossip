<?php
namespace SelvinOrtiz\Gossip;


/**
 * Class Gossip
 *
 * @author  Selvin Ortiz - https://selvinortiz.com
 * @package SelvinOrtiz\Gossip
 * @version 1.0.0
 */
class Gossip
{
    /**
     * @var static
     */
    protected static $instance;

    /**
     * @var callable[]
     */
    protected $responders = [];

    /**
     * @var callable[]
     */
    protected $once = [];

    protected function __construct() {}
    protected function __cone() {}

    /**
     * @return static
     */
    public static function instance()
    {
        if (static::$instance === null)
        {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * Registers a callable as an event responder
     *
     * @param string   $name
     * @param callable $responder
     */
    public function listen($name, callable $responder)
    {
        if (!array_key_exists($name, $this->responders)) {
            $this->responders[$name] = [];
        }

        $this->responders[$name][] = $responder;
    }

    /**
     * Registers an callback as an event responder that will remove itself after the first call
     *
     * @param string   $name
     * @param callable $responder
     *
     * @return $this
     */
    public function listenOnce($name, callable $responder)
    {
        if (!array_key_exists($name, $this->once)) {
            $this->once[$name] = [];
        }

        $this->once[$name][] = $responder;
    }

    /**
     * Quietly tells the responders about an event occurrence
     *
     * @param Event $event
     */
    public function whisper(Event $event)
    {
        $responders = $this->getEventResponders($event->name);

        if (!empty($responders)) {
            foreach ($responders as $responder) {
                call_user_func_array($responder, array_merge([&$event], $event->params));
            }
        }
    }

    /**
     * Returns all the registered responders for a given event
     *
     * @param string $name
     *
     * @return array|callable[]
     */
    protected function getEventResponders($name)
    {
        $responders = [];

        if (array_key_exists($name, $this->responders)) {
            $responders = $this->responders[$name];
        }

        if (array_key_exists($name, $this->once)) {
            foreach ($this->once[$name] as $index => $responder) {
                $responders[] = $responder;

                unset($this->once[$name][$index]);
            }
        }

        return $responders;
    }
}
