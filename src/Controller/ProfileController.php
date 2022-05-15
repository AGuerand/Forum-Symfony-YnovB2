<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfileController extends AbstractController
{
    #[Route('/profile', name:'app_profile')]
    public function showProduct(ProduitRepository $repo)
    {
        $produits = $repo->findAll();
        return $this->render('profile/index.html.twig', [
            'produits' => $produits,
        ]);
    }


}