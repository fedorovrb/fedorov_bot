<?php

namespace App\ExchangeRate;

use App\ExchangeRate\Interfaces\ExchangeRateInterface;

class ExchangeRateMonobank implements ExchangeRateInterface
{
    /**
     *
     */
    const BANK = 'monobank';

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
     * @var object
     */
    private object $entity;

    /**
     * @var object
     */
    private object $entityManager;


    public function __construct($entity, $entityManager)
    {
        $this->entity = $entity;
        $this->entityManager = $entityManager;
    }

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
     * @return bool
     */
    public function persistData()
    {

        if (count($this->data) === 1) {
            return false;
        }

        foreach ($this->data as $key) {
            switch ($key["currencyCodeB"]) {
                case $this->uah_iso_code:
                    switch ($key["currencyCodeA"]) {
                        case $this->usd_iso_code:
                            $this->entity->setUsd(round($key['rateBuy'], 2) . ' / ' . round($key['rateSell'], 2));
                            break;
                        case $this->euro_iso_code:
                            $this->entity->setEuro(round($key['rateBuy'], 2) . ' / ' . round($key['rateSell'], 2));
                            break;
                    }
                    break;
            }
        }

        $this->entity->setBank(self::BANK);
        $this->entityManager->persist($this->entity);
        $this->entityManager->flush();

        return true;
    }
}