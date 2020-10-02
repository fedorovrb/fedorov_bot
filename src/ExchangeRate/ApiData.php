<?php


namespace App\ExchangeRate;

class ApiData
{
    /**
     * @var ExchangeRateInterface
     */
    private ExchangeRateInterface $object;

    /**
     * ApiData constructor.
     * @param ExchangeRateInterface $object
     */
    public function __construct(ExchangeRateInterface $object)
    {
        $this->object = $object;
    }

    /**
     * @return mixed
     */
    public function run()
    {
        $this->object->getExchangeRateData();
        return $this->object->persistData();
    }
}