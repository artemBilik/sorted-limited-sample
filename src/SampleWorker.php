<?php

namespace Travelata\ArtemBilik;


use Worker;

class SampleWorker extends Worker
{
    /** @var Sample  */
    private $sample;
    /** @var FileProvider  */
    private $provider;
    /** @var SampleFactory  */
    private $sampleFactory;
    /** @var AutoLoader  */
    private $autoLoader;

    public function __construct(
        Sample $sample,
        FileProvider $provider,
        SampleFactory $sampleFactory,
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

    public function getSample(): Sample
    {
        return $this->sample;
    }

    public function getProvider(): FileProvider
    {
        return $this->provider;
    }

    public function getSampleFactory(): SampleFactory
    {
        return $this->sampleFactory;
    }
}