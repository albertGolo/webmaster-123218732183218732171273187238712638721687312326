<?php

// Just to see if this shit is actually installed :fire:

$cache = new Memcached();
$cache->addServer('localhost', 11211);

$item = $cache->get('ok');

if (!$item) {
    $time = time();
    $cache->set('ok', $time, 10);

    die("Set item value to {$time}");
}

echo "Item value is cached ({$item})";