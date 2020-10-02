<?php

namespace App\ExchangeRate;

interface ExchangeRateInterface
{
    public function getExchangeRateData();
    public function persistData();
}