<?php

namespace App\Service;

use App\Entity\Product;
use App\Repository\CountryRepository;

class ProductPriceCalculator
{
    private CountryRepository $countryRepository;

    /**
     * @param CountryRepository $countryRepository
     */
    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    /**
     * @param Product $product
     * @param string $taxNumber
     * @return float
     */
    public function getPriceByTaxNumber(Product $product, string $taxNumber): float
    {
        $countryCode = mb_substr($taxNumber, 0, 2);
        $country = $this->countryRepository->findOneBy(['countryCode' => mb_strtoupper($countryCode)]);

        return $product->getPrice() + ($product->getPrice() * ($country->getTaxPercentage() / 100));
    }
}