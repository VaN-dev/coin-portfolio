<?php

namespace App\Controller\Admin;

use App\Entity\Coin;
use App\Service\ApiClient\CoinmarketcapClient;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
    /**
     * @Route("/admin/user", name="admin.user")
     */
    public function index()
    {
        $users = $this->getDoctrine()->getRepository('App:User')->findAll();

        return $this->render('admin/user/index.html.twig', [
            'users' => $users,
        ]);
    }
}