<?php

namespace App\ExchangeRate\Interfaces;

interface ExchangeRateInterface
{
    public function getExchangeRateData();
    public function persistData();
}