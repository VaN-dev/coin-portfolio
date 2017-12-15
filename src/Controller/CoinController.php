<?php

namespace App\Controller;

use App\Entity\Coin;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class CoinController extends Controller
{
    /**
     * @Route("/coin", name="coin")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();

        $product = (new Coin())
            ->setName('Bitcoin')
            ->setSymbol('BTC')
        ;

        $em->persist($product);

        $em->flush();

        return new Response('Saved new coin with id '.$product->getId());
    }
}
