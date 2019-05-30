<?php

namespace Travelata\ArtemBilik;


use Threaded;
use Travelata\ArtemBilik\Exceptions\FilesFinishedException;
use Travelata\ArtemBilik\Exceptions\ReadFileException;


class SampleTask extends Threaded
{
    /** @var AutoLoader  */
    private $autoLoader;

    public function __construct(AutoLoader $autoloader)
    {
        $this->autoLoader = $autoloader;
    }

    public function run()
    {
        /** @var SampleWorker $worker */
        $worker = $this->worker;
        $sample = $worker->getSample();
        $provider = $worker->getProvider();

        while (true) {
            /** @var ChunkFileReader|null $file */
            $file = null;
            $provider->synchronized(function(FileProviderInterface $provider) use (&$file) {
                try {
                    $file = new ChunkFileReader($provider->getNext());
                } catch (FilesFinishedException $e) {
                    //
                }
            }, $provider);
            if ($file === null) {
                break;
            }
            $cacheSample = $worker->getSampleFactory()->create();
            while (!$file->isEnd()) {
                try {
                    $cacheSample->push($file->read(100000));
                } catch (ReadFileException $e) {
                    continue;
                }
            }
            $products = $cacheSample->getProducts();
            $sample->synchronized(function(SampleInterface $sample) use (&$products) {
                $sample->push($products);
            }, $sample);
        }
    }
}