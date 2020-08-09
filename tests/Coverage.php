<?php

  use Pest\PluginCoverage\Coverage;

  it('generates coverage based on file input', function () {
      expect(Coverage::getMissingCoverage(new class() {
         public function lineCoverageData(): array
         {
             return [
                 1   => ['foo'],
                 2   => ['bar'],
                 4   => [],
                 5   => [],
                 6   => [],
                 7   => null,
                 100 => null,
                 101 => ['foo'],
                 102 => [],
             ];
         }
     }))->toEqual([
        '4..6', '102',
    ]);
  });
