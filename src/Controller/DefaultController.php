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
        $assets  = $em->getRepository('App:Asset')->findBy(['user' => $this->getUser()]);

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
            'assets' => $assets,
            'assetForm' => $assetForm->createView(),
        ]);
    }
}