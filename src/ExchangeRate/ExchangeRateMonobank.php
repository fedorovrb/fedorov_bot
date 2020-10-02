<?php

namespace App\ExchangeRate;

class ExchangeRateMonobank extends ExchangeRateAbstract
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
    protected string $url = 'https://api.monobank.ua/bank/currency';


    public function __construct($entity, $entityManager)
    {
        parent::__construct($entity, $entityManager);
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