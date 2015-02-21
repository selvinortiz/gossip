<?php
require dirname(__FILE__).'/../vendor/autoload.php';

$events = new \SelvinOrtiz\Gossip\Gossip();

$events->on('cart.onBeforeClear', function($items)
{
	$message = 'The cart is about to be cleared, here are the items in the cart.';

	echo $message, PHP_EOL, '<pre>', print_r($items, true), '</pre>', PHP_EOL;
});

$events->notify(
	'cart.onBeforeClear',
	array(
		array('id' => 1, 'title' => 'Shirt', 'color' => 'White', 'price' => 1099),
		array('id' => 2, 'title' => 'Shorts', 'size' => 'XXL', 'price' => 1099),
	)
);


$events->notify(
	'cart.onBeforeClear',
	array(
		array('id' => 1, 'name' => 'Pants', 'price' => 2599),
	)
);
