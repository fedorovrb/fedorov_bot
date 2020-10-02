<?php

namespace App\ExchangeRate;

class ExchangeRatePrivatbank extends ExchangeRatePrivatNbuAbstract
{
    /**
     *
     */
    const BANK = 'privatbank';

    /**
     * @return bool
     */
    public function persistData()
    {

        if (count($this->data['exchangeRate']) === 0) {
            return false;
        }

        foreach ($this->data['exchangeRate'] as $key) {
           if (isset($key['currency'])) {
               switch ($key['currency']) {
                   case 'USD':
                       $this->entity->setUsd(round($key['purchaseRate'], 2) . ' / ' . round($key['saleRate'], 2));
                       break;
                   case 'EUR':
                       $this->entity->setEuro(round($key['purchaseRate'], 2) . ' / ' . round($key['saleRate'], 2));
                       break;
               }
           }
        }

        $this->entity->setBank(self::BANK);
        $this->entityManager->persist($this->entity);
        $this->entityManager->flush();

        return true;
    }
}