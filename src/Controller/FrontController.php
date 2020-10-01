<?php

namespace App\Controller;

use App\Entity\RatesEntity;
use App\ExchangeRate\ApiData;
use App\ExchangeRate\ExchangeRateMonobank;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Borsaco\TelegramBotApiBundle\Service\Bot;

class FrontController extends AbstractController
{
    /**
     * @Route("/webhook", name="webhook")
     */
    public function index(Bot $bot)
    {
//        $a = new ApiData(new ExchangeRateMonobank());
////        var_dump($a->getData()); die;
//
//        $bot = $bot->getBot()->getMe();
//
//
////       $bot->sendMessage(['chat_id' => '200624774', 'text' => 'sdasdas']);
//        $bot->getUpdates();
//        return $this->render('front/index.html.twig', [
//            'controller_name' => 'FrontController',
//        ]);
    }
}
