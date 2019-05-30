<?php

namespace Travelata\ArtemBilik;


use Worker;

class SampleWorker extends Worker
{
    /** @var SampleInterface  */
    private $sample;
    /** @var FileProviderInterface  */
    private $provider;
    /** @var SampleFactoryInterface  */
    private $sampleFactory;
    /** @var AutoLoader  */
    private $autoLoader;

    public function __construct(
        SampleInterface $sample,
        FileProviderInterface $provider,
        SampleFactoryInterface $sampleFactory,
        AutoLoader $autoLoader
    ) {
        $this->sample = $sample;
        $this->provider = $provider;
        $this->sampleFactory = $sampleFactory;
        $this->autoLoader = $autoLoader;
    }

    public function run(){
        $this->autoLoader->register();
    }

    public function getSample(): SampleInterface
    {
        return $this->sample;
    }

    public function getProvider(): FileProviderInterface
    {
        return $this->provider;
    }

    public function getSampleFactory(): SampleFactoryInterface
    {
        return $this->sampleFactory;
    }
}