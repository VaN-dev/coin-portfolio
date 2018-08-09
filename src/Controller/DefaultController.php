<?php

namespace App\Controller;

use App\Entity\Asset;
use App\Form\Type\AssetType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function index(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $portfolio = [];
        /* @var Asset[] $assets */
        if ($this->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $assets = $this->getUser()->getAssets();
            $fiat = $em->getRepository('App:Fiat')->findOneBy(['symbol' => 'EUR']);
            foreach ($assets as $asset) {
                $portfolio[] = [
                    'asset' => $asset,
                    'ticker' => $em->getRepository('App:Ticker')->findOneBy(['coin' => $asset->getCoin(), 'fiat' => $fiat], ['createdAt' => 'DESC']),
                ];
            }
        }

        $asset = (new Asset())
            ->setUser($this->getUser())
        ;
        $assetForm = $this->createForm(AssetType::class, $asset);

        $assetForm->handleRequest($request);

        if ($assetForm->isSubmitted() && $assetForm->isValid()) {
            $em->persist($asset);
            $em->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('default/index.html.twig', [
            'portfolio' => $portfolio,
            'assetForm' => $assetForm->createView(),
        ]);
    }
}
