<?php


namespace App\ExchangeRate;


abstract class ExchangeRateAbstract implements ExchangeRateInterface
{

    /**
     * @var array
     */
    protected array $data = [];

    /**
     * @var object
     */
    protected object $entity;

    /**
     * @var object
     */
    protected object $entityManager;


    public function __construct($entity, $entityManager)
    {
        $this->entity = $entity;
        $this->entityManager = $entityManager;
    }

    /**
     * @return mixed
     */
    public function getExchangeRateData(): array
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $this->url);
        $result = curl_exec($ch);
        curl_close($ch);

        $this->data = json_decode($result, true);

        return $this->data;
    }
}