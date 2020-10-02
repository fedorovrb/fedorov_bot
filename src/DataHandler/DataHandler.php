<?php

namespace App\DataHandler;


class DataHandler implements DataHandlerInterface
{

    /**
     * @var
     */
    private $monobankRatesData;

    /**
     * @var
     */
    private $privatbankRatesData;

    /**
     * @var
     */
    private $nbuRatesData;

    /**
     * @param mixed $monobankRatesData
     */
    public function setMonobankRatesData(object $monobankRatesData): void
    {
        $this->monobankRatesData = $monobankRatesData;
    }

    /**
     * @param mixed $privatbankRatesData
     */
    public function setPrivatbankRatesData(object $privatbankRatesData): void
    {
        $this->privatbankRatesData = $privatbankRatesData;
    }

    /**
     * @param mixed $nbuRatesData
     */
    public function setNbuRatesData(object $nbuRatesData): void
    {
        $this->nbuRatesData = $nbuRatesData;
    }

    /**
     * @param $bot
     */
    public function handle($bot)
    {
        $updates = \json_decode((string)$bot->getWebhookUpdate());

        switch ($updates->message->text) {

            case '/rates':
                $bot->sendMessage(['chat_id' => $updates->message->from->id, 'text' =>
                    'НБУ ' . PHP_EOL . PHP_EOL .
                    '💶 Евро: *' . $this->nbuRatesData->getEuro() . ' UAH*' . PHP_EOL .
                    '💵 Доллар: *' . $this->nbuRatesData->getUsd() . ' UAH*' . PHP_EOL . PHP_EOL .
                    'Данные на *' . date_format($this->nbuRatesData->getDate(), 'd-m-Y H:i') . '*' . PHP_EOL . PHP_EOL .
                    '-----------------------------------------------' . PHP_EOL .
                    'Приватбанк ' . PHP_EOL . PHP_EOL .
                    '💶 Евро: *' . $this->privatbankRatesData->getEuro() . ' UAH*' . PHP_EOL .
                    '💵 Доллар: *' . $this->privatbankRatesData->getUsd() . ' UAH*' . PHP_EOL . PHP_EOL .
                    'Данные на *' . date_format($this->privatbankRatesData->getDate(), 'd-m-Y H:i') . '*' . PHP_EOL . PHP_EOL .
                    '-----------------------------------------------' . PHP_EOL .
                    'Монобанк ' . PHP_EOL . PHP_EOL .
                    '💶 Евро: *' . $this->monobankRatesData->getEuro() . ' UAH*' . PHP_EOL .
                    '💵 Доллар: *' . $this->monobankRatesData->getUsd() . ' UAH*' . PHP_EOL . PHP_EOL .
                    'Данные на *' . date_format($this->monobankRatesData->getDate(), 'd-m-Y H:i') . '*', 'parse_mode' => 'Markdown']);
                break;
            default:
                $bot->sendMessage(['chat_id' => $updates->message->from->id, 'text' => 'Для получения текущих курсов валют выполните команду /rates']);
                break;
        }
    }
}