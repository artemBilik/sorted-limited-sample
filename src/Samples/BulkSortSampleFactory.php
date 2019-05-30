<?php

namespace Travelata\ArtemBilik\Samples;


use Travelata\ArtemBilik\SampleFactoryInterface;
use Travelata\ArtemBilik\SampleInterface;

class BulkSortSampleFactory implements SampleFactoryInterface
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

    public function create(): SampleInterface
    {
        return new BulkSortSample($this->size, $this->limit);
    }
}