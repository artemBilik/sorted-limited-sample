<?php

namespace Travelata\ArtemBilik;


use SplFileObject;
use Travelata\ArtemBilik\Exceptions\CorruptedProductCsvException;
use Travelata\ArtemBilik\Exceptions\ReadFileException;


class ChunkFileReader extends SplFileObject
{
    /**
     * @param int $size
     * @return Product[]
     * @throws ReadFileException
     */
    public function read(int $size): array
    {
        $concat = '';
        $products = [];
        while (!$this->isEnd()) {
            $s = $concat . $this->fread(1024 * 2);
            if ($s === false) {
                throw new ReadFileException($this->getPathname());
            }
            $data = explode(PHP_EOL, $s);
            if (substr($s, -1) !== PHP_EOL) {
                $concat = array_pop($data);
            } else {
                $concat = '';
            }
            foreach ($data as $item) {
                try {
                    $products[] = Product::fromCsv($item);
                } catch(CorruptedProductCsvException $e) {
                    //
                }
                if (count($products) >= $size) {
                    return $products;
                }
            }
        }
        return $products;
    }

    public function isEnd(): bool
    {
        return $this->eof();
    }
}

