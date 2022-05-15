<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\Produit;
use App\Form\CommentaireFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DetailController extends AbstractController
{
    #[Route('produit/show/{id}', name: 'app_details')]
    public function details(Request $request, EntityManagerInterface $manager, Produit $produit, Commentaire $commentaire=null)
    {
        $user = $this->getUser();
        $commentaire = new Commentaire;
        $commentaire->setUserId($user);
        $commentaire->setProduitId($produit);
        $commentaire->setCreatedAt(new \DateTime());

        $form = $this->createForm(CommentaireFormType::class, $commentaire);
        $form->handleRequest($request);
        dump($form);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($commentaire);
            $manager->flush();
            return $this->redirectToRoute('app_details',[
                'id' => $produit->getId()
            ]
            );
        }

        return $this->render('details/index.html.twig', [
            'produit'=> $produit,
            'formCommentaire' => $form->createView()
        ]);
    }
}
