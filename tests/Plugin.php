<?php

use Pest\PluginCoverage\Coverage;
use Pest\PluginCoverage\Plugin;
use Pest\TestSuite;
use Symfony\Component\Console\Output\ConsoleOutput;

it('has plugin')->assertTrue(class_exists(Plugin::class));

it('adds coverage if --coverage exist', function () {
    $plugin = new Plugin(new ConsoleOutput());
    $testSuite = TestSuite::getInstance();

    expect($plugin->coverage)->toBeFalse();
    $arguments = $plugin->handleArguments([]);
    expect($arguments)->toEqual([]);
    expect($plugin->coverage)->toBeFalse();

    $arguments = $plugin->handleArguments(['--coverage']);
    expect($arguments)->toEqual(['--coverage-php', Coverage::getPath()]);
    expect($plugin->coverage)->toBeTrue();
});

it('adds coverage if --min exist', function () {
    $plugin = new Plugin(new ConsoleOutput());
    expect($plugin->coverageMin)->toEqual(0.0);

    expect($plugin->coverage)->toBeFalse();
    $plugin->handleArguments([]);
    expect($plugin->coverageMin)->toEqual(0.0);

    $plugin->handleArguments(['--min=2']);
    expect($plugin->coverageMin)->toEqual(2.0);

    $plugin->handleArguments(['--min=2.4']);
    expect($plugin->coverageMin)->toEqual(2.4);
});
