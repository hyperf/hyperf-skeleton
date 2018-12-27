<?php
/**
 * Initial a dependency injection container that implemented PSR-11 and return the container.
 */

declare(strict_types=1);

use Hyperf\Config\ProviderConfig;
use Hyperf\Di\Annotation\Scanner;
use Hyperf\Di\Container;
use Hyperf\Di\Definition\DefinitionSource;
use Hyperf\Framework\Hyperf;

$configFromProviders = ProviderConfig::load();
$definitions = include __DIR__ . '/dependencies.php';
$serverDependencies = array_replace($configFromProviders['dependencies'] ?? [], $definitions['dependencies'] ?? []);

$annotations = include __DIR__ . '/autoload/annotations.php';
$scanDirs = $configFromProviders['scan']['paths'];
$scanDirs = array_merge($scanDirs, $annotations['scan']['paths'] ?? []);

$definitionSource = new DefinitionSource($serverDependencies, $scanDirs, new Scanner());
$container = new Container($definitionSource);


if (! $container instanceof \Psr\Container\ContainerInterface) {
    throw new RuntimeException('The dependency injection container is invalid.');
}
return Hyperf::setContainer($container);