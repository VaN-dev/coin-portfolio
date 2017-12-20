<?php

namespace App\Controller;

use App\Entity\Coin;
use App\Entity\Ticker;
use App\Service\ApiClient\CoinmarketcapClient;
use App\Service\Ticker\Refresher;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TickerController extends Controller
{
    /**
     * @Route("/ticker/refresh", name="ticker.refresh")
     *
     * @param Refresher $refresher
     * @return JsonResponse
     */
    public function fetch(Refresher $refresher)
    {
        $tickers = $refresher->refresh();

        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse(['success' => true], 200);
    }
}
