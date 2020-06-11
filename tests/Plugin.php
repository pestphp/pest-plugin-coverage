<?php

use Pest\PluginCoverage\Coverage;
use Pest\PluginCoverage\Plugin;
use Pest\TestSuite;
use Symfony\Component\Console\Output\ConsoleOutput;

it('has plugin')->assertTrue(class_exists(Plugin::class));

  it('adds coverage if --coverage exist', function () {
      $plugin = new Plugin(new ConsoleOutput());
      $testSuite = TestSuite::getInstance();

      assertFalse($plugin->coverage);
      $arguments = $plugin->handleArguments([]);
      assertEquals([], $arguments);
      assertFalse($plugin->coverage);

      $arguments = $plugin->handleArguments(['--coverage']);
      assertEquals(['--coverage-php', Coverage::getPath()], $arguments);
      assertTrue($plugin->coverage);
  });

  it('adds coverage if --min exist', function () {
      $plugin = new Plugin(new ConsoleOutput());
      assertEquals($plugin->coverageMin, 0.0);

      assertFalse($plugin->coverage);
      $plugin->handleArguments([]);
      assertEquals($plugin->coverageMin, 0.0);

      $plugin->handleArguments(['--min=2']);
      assertEquals($plugin->coverageMin, 2.0);

      $plugin->handleArguments(['--min=2.4']);
      assertEquals($plugin->coverageMin, 2.4);
  });
