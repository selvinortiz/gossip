![Gossip](Gossip.png)

[![Build Status](https://travis-ci.org/selvinortiz/gossip.png)](https://travis-ci.org/selvinortiz/gossip)
[![Total Downloads](https://poser.pugx.org/selvinortiz/gossip/d/total.png)](https://packagist.org/packages/selvinortiz/gossip)
[![Latest Stable Version](https://poser.pugx.org/selvinortiz/gossip/v/stable.png)](https://packagist.org/packages/selvinortiz/gossip)

### Description
>**Gossip** is a tiny event broadcasting library written by [Selvin Ortiz](https://selvinortiz.com)

### Requirements
- PHP 5.4+
- [Composer](http://getcomposer.org) and [selvinortiz/gossip](https://packagist.org/packages/selvinortiz/gossip)

### Install
```bash
composer require selvinortiz/gossip
```

### Test
```bash
sh spec.sh
```

### Usage
> Event broadcasting is a fancy way of saying that **Gossip** allows you to register your _responders_ to _listen_ for a specific event and when that event is _whispered_, it can respond.

```php

use SelvinOrtiz\Gossip\Gossip;

class App
{
	public function init()
	{
		Gossip::instance()->whisper(new Event('app.init'));
	}

	public function end()
	{
		Gossip::instance()->whisper(new Event('app.end', [$this]));
	}

	public function log($message)
	{
		// Log a $message to db or file system
	}
}

// Called when app.init is whisper()ed
Gossip::instance()->listen('app.init', function (Event &$event) {
	// Bootstrap third party code, initialize services, etc.
});

// Called only the first time app.end is whisper()ed
Gossip::instance()->listenOnce('app.end', function (Event &$event, $app) {
	// Close db connections, destroy sessions, etc.
	$app->log('Application is ending...');
});
```

### API
> API reference is coming soon...

### Contribute
> **Gossip** wants to be friendly to _first time contributors_. Just follow the steps below and if you have questions along the way, please reach out.

1. Fork it!
1. Create your bugfix or feature branch
1. Commit and push your changes
1. Submit a pull request

### License
**Gossip** is open source software licensed under the [MIT License](LICENSE.txt)
