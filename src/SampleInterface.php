<?php

namespace Travelata\ArtemBilik;


use Closure;

interface SampleInterface
{

    public function synchronized(Closure $function);

    /**
     * @param Product[] $products
     */
    public function push(array $products): void;

    /**
     * @return Product[]
     */
    public function getProducts(): array;

}