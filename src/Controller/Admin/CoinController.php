<?php

namespace App\Controller\Admin;

use App\Entity\Coin;
use App\Service\ApiClient\CoinmarketcapClient;
use App\Service\Coin\Importer;
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
     * @param Importer $importer
     * @return RedirectResponse
     */
    public function sync(Importer $importer)
    {
        $coins = $importer->import();

        $this->getDoctrine()->getManager()->flush();

        return new RedirectResponse($this->generateUrl('admin.coin'));
    }
}