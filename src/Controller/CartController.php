<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(RequestStack $rs, ProduitRepository $repo): Response
    {
        $session = $rs->getSession();
        $cart = $session->get('cart', []);
        $qt = 0;
        

        $cartWithData = [];

        foreach ($cart as $id => $quantity) {
            $cartWithData[] = [
                'product' => $repo->find($id),
                'quantity' => $quantity
            ];
            $qt += $quantity;
        }

        $session->set('qt', $qt);
        $total = 0;

        foreach ($cartWithData as $item) {
            $totalItem = $item['product']->getPrix() * $item['quantity'];
            $total += $totalItem;
        }


        return $this->render('cart/index.html.twig', [
            'items' => $cartWithData,
            'total' => $total
        ]);
    }

    #[Route('/cart/add/{id}', name: 'cart_add')]
    public function add($id, CartService $cs)
    {

        $cs->add($id);
        return $this->redirectToRoute('app_cart');
    }
    
    #[Route('/cart/removeone/{id}', name: 'cart_removeone')]
    public function removeone($id, CartService $cs)
    {

        $cs->removeone($id);
        return $this->redirectToRoute('app_cart');
        
    }

    #[Route('/cart/remove/{id}', name: 'cart_remove')]
    public function remove($id, RequestStack $rs)
    {

        $session = $rs->getSession();
        $cart = $session->get('cart', []);

        if (!empty($cart[$id])) {
            unset($cart[$id]);
        }

        $session->set('cart', $cart);
        return $this->redirectToRoute('app_cart');
    }

    #[Route('/cart/removeall', name: 'cart_removeall')]
    public function removeall(RequestStack $rs)
    {

        $session = $rs->getSession();
        $cart = $session->get('cart', []);
        

        

        $session->set('cart', []);
        return $this->redirectToRoute('app_cart');
    }
    #[Route('/cart/paid', name: 'cart_paid')]
    public function paid(RequestStack $rs)
    {

        $session = $rs->getSession();
        $cart = $session->get('cart', []);
        

        

        $session->set('cart', []);
        return $this->redirectToRoute('app_paid');
    }
    #[Route('/paid', name: 'app_paid')]
    public function paida()
    {
        
        return $this->render('cart/paid.html.twig', [
            
        ]);
    }
}
