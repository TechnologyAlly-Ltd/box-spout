<?php

namespace TA\Spout\Autoloader;

require_once 'Psr4Autoloader.php';

/**
 * @var string
 * Full path to "src/Spout" which is what we want "TA\Spout" to map to.
 */
$srcBaseDirectory = \dirname(\dirname(__FILE__));

$loader = new Psr4Autoloader();
$loader->register();
$loader->addNamespace('TA\Spout', $srcBaseDirectory);
