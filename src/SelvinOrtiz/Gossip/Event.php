<?php
namespace SelvinOrtiz\Gossip;


/**
 * Class Event
 *
 * @package SelvinOrtiz\Gossip
 */
class Event
{
    /**
     * Fully qualified event name (app.init)
     *
     * @var string
     */
    public $name;

    /**
     * @var array
     */
    public $params = [];

    /**
     * Whether or not to continue on in the flow
     *
     * @var bool
     */
    public $continue = true;

    /**
     * Event constructor.
     *
     * @param string $name
     * @param array  $params
     */
    public function __construct($name, array $params = [])
    {
        $this->name   = $name;
        $this->params = $params;
    }
}
