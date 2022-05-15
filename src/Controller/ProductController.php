<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends AbstractController
{
    #[Route('/', name: 'app_product')]
    public function index(Request $request, ProduitRepository $repo): Response
    {
        $produit = $repo->findAll();

        // dd($request);
        $input = ($request->query->get('query'));
        dump($input);

        return $this->render('product/index.html.twig', [
            'products' => $produit,
            'input' => $input
        ]);
    }
}