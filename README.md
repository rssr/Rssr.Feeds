Rssr.Feeds
=============

Rssr feeds creates a layer between your application and different implementations of XML feeds.

[![Build Status](https://api.travis-ci.org/rssr/Rssr.Feeds.svg)](https://travis-ci.org/rssr/Rssr.Feeds)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/rssr/Rssr.Feeds/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/rssr/Rssr.Feeds/?branch=master)

## Installation

As this library is not published to packagist, it requires a repository entry in your `composer.json` file.

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/rssr/Rssr.Feeds"
        }
    ]
}
```

## Feed types
```php

// First, get a SimpleXMLElement object
$atomXml = simplexml_load_string('...');

// Initialize the feed with that data
$feed = new \Rssr\Feed\Atom($atomXml);
```

## Feed factory

The feed factory uses `Rssr\Feed\FeedInterface::init` to properly parse the feed data into a usable instance

```php
$factory = new \Rssr\Feed\Factory;

$factory->addHandler('Rssr\Feed\Atom');
$factory->addHandler('Rssr\Feed\Rss');

// We don't know if this is an atom or rss2.0 feed!
$unknownType = simplexml_load_string('...');

// now you can interact with the feed without caring what type!
$feed = $factory->newFeed($unknownType);

```

## Extending functionality

By creating a class that implements `Rssr\Feed\FeedInterface`, you can add another feed type (maybe a database type!) to handle data from a different source but interact with the feed the same way

Test addition
