<?php

namespace Travelata\ArtemBilik\FileProviders;


use Threaded;
use Travelata\ArtemBilik\Exceptions\FilesFinishedException;
use Travelata\ArtemBilik\FileProviderInterface;

class ListFileProvider extends Threaded implements FileProviderInterface
{
    /** @var string[] */
    private $files = [];
    /** @var int  */
    private $position = 0;

    public function addFile(string $filePath): void
    {
        $this->files[] = $filePath;
    }

    /** {@inheritDoc} */
    public function getNext(): string
    {
        if ($this->position >= count($this->files)) {
            throw new FilesFinishedException();
        }
        return $this->files[$this->position++];
    }

}