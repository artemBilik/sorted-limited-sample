<?php

namespace Travelata\ArtemBilik;


class SampleFactory
{
    /** @var int  */
    private $size;
    /** @var int  */
    private $limit;

    public function __construct(int $size, int $limit)
    {
        $this->size = $size;
        $this->limit = $limit;
    }

    public function create(): Sample
    {
        return new Sample($this->size, $this->limit);
    }
}