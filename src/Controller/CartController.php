<?php

namespace App\Controller;
use App\Entity\Vols;
use App\Repository\VolsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


    #[Route('/cart', name: 'cart_')]

    class CartController extends AbstractController
{

    /**
     * @Route("/", name="index")
     */
    public function index( SessionInterface $session, VolsRepository $volsRepository)
    {
        $panier = $session->get("panier", []);

        // On "fabrique" les données
        $dataPanier = [];
        $total = 0;

        foreach($panier as $id => $quantite){
            $vols = $volsRepository->find($id);
            $dataPanier[] = [
                "vols" => $vols,
                "quantite" => $quantite
            ];
            $total += $vols->gettarif() * $quantite;
        }

        return $this->render('cart/index.html.twig', compact("dataPanier", "total"));
    }


    /**
     * @Route("/add/{id}", name="add")
     */
    public function add(vols $vols, SessionInterface $session)
    {
      //on recupère le panier actuel 
      $panier = $session->get("panier",[]);
      $id=$vols->getId();

      if(!empty($panier[$id])){
       
        $panier[$id]++;
      

      }else{
        $panier[$id]=1;
      }
      //on sauvegarde dans la session
      $session->set("panier",$panier);

        return $this->redirectToRoute("cart_index");

    }  
    


/**
     * @Route("/remove/{id}", name="remove")
     */
    public function remove(vols $vols, SessionInterface $session)
    {
        // On récupère le panier actuel
        $panier = $session->get("panier", []);
        $id = $vols->getId();

        if(!empty($panier[$id])){
            if($panier[$id] > 1){
                $panier[$id]--;
            }else{
                unset($panier[$id]);
            }
        }

        // On sauvegarde dans la session
        $session->set("panier", $panier);

        return $this->redirectToRoute("cart_index");
    }
    

     /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(vols $vols, SessionInterface $session)
    {
        // On récupère le panier actuel
        $panier = $session->get("panier", []);
        $id = $vols->getId();

        if(!empty($panier[$id])){
            unset($panier[$id]);
        }

        // On sauvegarde dans la session
        $session->set("panier", $panier);

        return $this->redirectToRoute("cart_index");
    }

    /**
     * @Route("/delete", name="delete_all")
     */
    public function deleteAll(SessionInterface $session)
    {
        $session->remove("panier");

        return $this->redirectToRoute("cart_index");
    }

}

