<?php

namespace App\ExchangeRate;

abstract class ExchangeRatePrivatNbuAbstract extends ExchangeRateAbstract
{

    /**
     * @var string
     */
    protected string $url = 'https://api.privatbank.ua/p24api/exchange_rates?json';

    public function __construct($entity, $entityManager)
    {
        parent::__construct($entity, $entityManager);
        $this->url = $this->url . '&date=' . date('d.m.Y');
    }

    abstract public function persistData();
}