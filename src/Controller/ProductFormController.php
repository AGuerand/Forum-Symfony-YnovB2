<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\ProductFormType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductFormController extends AbstractController
{
    #[Route('/form', name: '8747')]
    public function index(Request $request, EntityManagerInterface $entityManager, ManagerRegistry $doctrine): Response
    {
        
        $product = new Produit();
        $form = $this->createForm(ProductFormType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $user->getUsername();


            $entityManager = $doctrine->getManager();

            $product->setUserId($user);


            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $entityManager->persist($product);

            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();

            return $this->redirectToRoute('app_product');
        };

        return $this->render('product_form/index.html.twig', [
            'product_form' => $form->createView(),
        ]);
    }
}
