<?php

namespace App\ExchangeRate;

use App\ExchangeRate\Interfaces\ExchangeRateInterface;

class ExchangeRateMonobank implements ExchangeRateInterface
{
    /**
     * @var int
     */
    private int $usd_iso_code = 840;

    /**
     * @var int
     */
    private int $euro_iso_code = 978;

    /**
     * @var int
     */
    private int $uah_iso_code = 980;

    /**
     * @var string
     */
    private string $url = 'https://api.monobank.ua/bank/currency';

    /**
     * @var array
     */
    private array $data = [];

    /**
     * @return mixed
     */
    public function getExchangeRateData()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $this->url);
        $result = curl_exec($ch);
        curl_close($ch);

        $this->data = json_decode($result, true);

        return $this->data;
    }

    /**
     * @return array|false
     */
    public function transformData()
    {
        $result = [];

        if (count($this->data) === 1) {
            return false;
        }

        foreach ($this->data as $key) {
            switch ($key["currencyCodeB"]) {
                case $this->uah_iso_code:
                    switch ($key["currencyCodeA"]) {
                        case $this->usd_iso_code:
                            $result['usd_buy'] = round($key['rateBuy'], 2);
                            $result['usd_sell'] = round($key['rateSell'], 2);
                            break;
                        case $this->euro_iso_code:
                            $result['euro_buy'] =  round($key['rateBuy'], 2);
                            $result['euro_sell'] = round($key['rateSell'], 2);
                            break;
                    }
                    break;
            }
        }

        return $result;
    }
}