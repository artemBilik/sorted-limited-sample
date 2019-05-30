<?php

namespace Travelata\ArtemBilik;


use Travelata\ArtemBilik\Exceptions\CorruptedProductCsvException;

class Product
{
    private const CSV_SEPARATOR = ';';

    /** @var int  */
	private $id;
	/** @var string */
	private $name;
	/** @var string  */
	private $condition;
	/** @var string  */
	private $state;
	/** @var float  */
	private $price;

    /**
     * @param string $line
     * @return Product
     * @throws CorruptedProductCsvException
     */
    public static function fromCsv(string $line): self
    {
        $product = explode(self::CSV_SEPARATOR, $line);
        if (count($product) === 5) {
            return new self((int)$product[0], (string)$product[1], (string)$product[2], (string)$product[3], (float)$product[4]);
        }
        throw new CorruptedProductCsvException();
    }

	public function __construct(int $id, string $name, string $condition, string $state, float $price)
	{
		$this->id = $id;
		$this->name = $name;
		$this->condition = $condition;
		$this->state = $state;
		$this->price = $price;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getPrice(): float
	{
		return $this->price;
	}

	public function toCsv(): string
    {
        $data = [
            $this->getId(),
            $this->name,
            $this->condition,
            $this->state,
            sprintf('%sRUB', number_format($this->getPrice(), 2))
        ];
        return implode(self::CSV_SEPARATOR, $data);
    }
}