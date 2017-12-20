<?php

namespace App\Controller\Admin;

use App\Entity\Coin;
use App\Service\ApiClient\CoinmarketcapClient;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class CoinController extends Controller
{
    /**
     * @Route("/admin/coin", name="admin.coin")
     */
    public function index()
    {
        $coins = $this->getDoctrine()->getRepository('App:Coin')->findBy([], ['name' => 'ASC']);

        return $this->render('admin/coin/index.html.twig', [
            'coins' => $coins,
        ]);
    }

    /**
     * @Route("/admin/coin/sync", name="admin.coin.sync")
     *
     * @param CoinmarketcapClient $client
     * @return RedirectResponse
     */
    public function sync(CoinmarketcapClient $client)
    {
        $em = $this->getDoctrine()->getManager();

        $remoteCoins = $client->getCoins();
        $localCoins = array_map(function(Coin $coin) { return ['name' => $coin->getName(), 'symbol' => $coin->getSymbol()]; }, $em->getRepository('App:Coin')->findAll());

        $missingCoins = array_filter($remoteCoins, function ($coin) use ($localCoins) {
            return !in_array($coin, $localCoins);
        });

        foreach($missingCoins as $missingCoin) {
            $coin = (new Coin())
                ->setName($missingCoin['name'])
                ->setSymbol($missingCoin['symbol'])
            ;
            $em->persist($coin);
        }

        $em->flush();

        return new RedirectResponse($this->generateUrl('admin.coin'));
    }
}