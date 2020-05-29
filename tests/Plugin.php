<?php

use Pest\PluginCoverage\Coverage;
use Pest\PluginCoverage\Plugin;
use Pest\TestSuite;

it('has plugin')->assertTrue(class_exists(Plugin::class));

  it('adds coverage if --coverage exist', function () {
      $plugin = new Plugin();
      $testSuite = TestSuite::getInstance();

      assertFalse($plugin->coverage);
      $arguments = $plugin->handleArguments($testSuite, []);
      assertEquals([], $arguments);
      assertFalse($plugin->coverage);

      $arguments = $plugin->handleArguments($testSuite, ['--coverage']);
      assertEquals(['--coverage-php', Coverage::getPath()], $arguments);
      assertTrue($plugin->coverage);
  });

  it('adds coverage if --min exist', function () {
      $testSuite = TestSuite::getInstance();
      $plugin = new Plugin();
      assertEquals($plugin->coverageMin, 0.0);

      assertFalse($plugin->coverage);
      $plugin->handleArguments($testSuite, []);
      assertEquals($plugin->coverageMin, 0.0);

      $plugin->handleArguments($testSuite, ['--min=2']);
      assertEquals($plugin->coverageMin, 2.0);

      $plugin->handleArguments($testSuite, ['--min=2.4']);
      assertEquals($plugin->coverageMin, 2.4);
  });
