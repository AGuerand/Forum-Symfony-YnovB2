<?php

namespace App\Service;

use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\RequestStack;

class CartService
{
    private $repo;
    private $rs;

    public function __construct(ProduitRepository $repo, RequestStack $rs)
    {
        $this->repo = $repo;
        $this->rs = $rs;

    }

    public function add($id){

        $session = $this->rs->getSession();


        $cart = $session->get('cart', []);


        $qt = 0; 

        if (!empty($cart[$id]))
            $cart[$id]++;
        else
            $cart[$id] = 1;

        $session->set('cart', $cart);

    }
    
    public function removeone($id){

        $session = $this->rs->getSession();


        $cart = $session->get('cart', []);


        $qt = 0; 

        if ($cart[$id] >= 1)
            $cart[$id]--;
        else
        unset($cart[$id]);

        $session->set('cart', $cart);

    }
}