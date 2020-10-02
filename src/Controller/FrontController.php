<?php

namespace App\Controller;

use App\DataHandler\DataHandlerInterface;
use App\Entity\RatesEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Borsaco\TelegramBotApiBundle\Service\Bot;

class FrontController extends AbstractController
{

    protected Bot $bot;

    protected DataHandlerInterface $dataHandler;

    public function __construct(Bot $bot, DataHandlerInterface $dataHandler)
    {
        $this->bot = $bot;
        $this->dataHandler = $dataHandler;
    }
    /**
     * @Route("/webhook", name="webhook")
     */
    public function index(): Response
    {

        $this->dataHandler->setMonobankRatesData($this->getDoctrine()->getRepository(RatesEntity::class)->findByBank('monobank'));
        $this->dataHandler->setPrivatbankRatesData($this->getDoctrine()->getRepository(RatesEntity::class)->findByBank('privatbank'));
        $this->dataHandler->setNbuRatesData($this->getDoctrine()->getRepository(RatesEntity::class)->findByBank('nbu'));
        $this->dataHandler->handle($this->bot->getBot());

        return new Response('Ok');
    }
}
