<?php

namespace Travelata\ArtemBilik;


use DirectoryIterator;
use Pool;
use SplFileObject;
use Travelata\ArtemBilik\FileProviders\ListFileProvider;
use Travelata\ArtemBilik\Samples\BulkSortSampleFactory;

const THREADS_NUMBER = 16;

require_once __DIR__.'/AutoLoader.php';
(new AutoLoader())->register();
$start = microtime(true);

$sampleFactory = new BulkSortSampleFactory(1000, 20);
$sample = $sampleFactory->create();
$fileProvider = new ListFileProvider();
foreach (new DirectoryIterator(sprintf('%s/../files/', __DIR__)) as $file) {
    if ($file->getExtension() === 'csv') {
        $fileProvider->addFile($file->getPathname());
    }
}

$pool = new Pool(THREADS_NUMBER, SampleWorker::class, [$sample, $fileProvider, $sampleFactory, new AutoLoader()]);
for ($i = 0; $i < THREADS_NUMBER; $i++) {
    $pool->submit(new SampleTask());
}
$pool->shutdown();

$result = new SplFileObject(__DIR__.'/../result.csv', 'w');
$csv = array_map(function (Product $product) {
    return $product->toCsv();
}, $sample->getProducts());
$result->fwrite(implode(PHP_EOL, $csv));
printf("Parse in %.2f seconds" . PHP_EOL, microtime(true) - $start);