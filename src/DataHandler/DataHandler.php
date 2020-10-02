<?php

namespace App\DataHandler;


class DataHandler implements DataHandlerInterface
{

    /**
     * @var
     */
    private $monobankRatesData;

    /**
     * @param mixed $monobankRatesData
     */
    public function setMonobankRatesData(object $monobankRatesData): void
    {
        $this->monobankRatesData = $monobankRatesData;
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
                    'Monobank ' . PHP_EOL . PHP_EOL .
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