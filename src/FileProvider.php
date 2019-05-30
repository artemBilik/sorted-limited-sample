<?php

namespace Travelata\ArtemBilik;


use Threaded;
use Travelata\ArtemBilik\Exceptions\FilesFinishedException;

class FileProvider extends Threaded
{
    /** @var string[] */
    private $files = [];
    /** @var int  */
    private $position = 0;

    public function addFile(string $filePath): void
    {
        $this->files[] = $filePath;
    }

    /**
     * @return string
     * @throws FilesFinishedException
     */
    public function getNext(): string
    {
        if ($this->position >= count($this->files)) {
            throw new FilesFinishedException();
        }
        return $this->files[$this->position++];
    }

}