<?php

namespace Travelata\ArtemBilik;


use Threaded;

class Sample extends Threaded
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

    /**
     * @return Product[]
     */
    public function getProducts(): array
    {
        $products = [];
        foreach ($this->data as $product) {
            $products[] = $product;
        }
        return $products;
    }

    /**
     * @param Product[] $products
     */
    public function bulkPush(array $products): void
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