<?php

namespace App\Controller;

use App\Form\Type\DefaultFiatType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FiatController extends Controller
{
    /**
     * @Route("/fiat/default-fiat-form", name="fiat.default_fiat_form")
     */
    public function defaultFiatForm()
    {
        $form = $this->createForm(DefaultFiatType::class);

        return $this->render('fiat/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
