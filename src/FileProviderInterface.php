<?php

namespace Travelata\ArtemBilik;


use Closure;
use Travelata\ArtemBilik\Exceptions\FilesFinishedException;

interface FileProviderInterface
{
    public function synchronized(Closure $function);

    /**
     * @return string
     * @throws FilesFinishedException
     */
    public function getNext(): string;
}