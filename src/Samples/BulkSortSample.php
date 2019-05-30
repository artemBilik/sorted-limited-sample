<?php

namespace Travelata\ArtemBilik\Samples;


use Threaded;
use Travelata\ArtemBilik\Product;
use Travelata\ArtemBilik\SampleInterface;

class BulkSortSample extends Threaded implements SampleInterface
{
    /** @var Product[]  */
    private $data = [];
    /** @var int  */
    private $size = 0;
    /** @var int  */
    private $uniqueSize;

    public function __construct(int $size, int $uniqueSize)
    {
        $this->size = $size;
        $this->uniqueSize = $uniqueSize;
    }

    /** {@inheritDoc} */
    public function getProducts(): array
    {
        $products = [];
        foreach ($this->data as $product) {
            $products[] = $product;
        }
        return $products;
    }

    /** {@inheritDoc} */
    public function push(array $products): void
    {
        foreach ($this->data as $key => $product) {
            $products[] = $product;
            unset($this->data[$key]);
        }
        usort($products, function (Product $value1, Product $value2) {
            return $value1->getPrice() - $value2->getPrice();
        });
        $products = array_slice($products, 0, $this->size);
        $cache = [];
        /**  @var Product $item */
        $key = 0;
        foreach ($products as $item) {
            if (!isset($cache[$item->getId()])) {
                $cache[$item->getId()] = 1;
            } else {
                $cache[$item->getId()]++;
            }
            if ($cache[$item->getId()] <= $this->uniqueSize) {
                $this->data[$key++] = $item;
            }
        }
    }
}