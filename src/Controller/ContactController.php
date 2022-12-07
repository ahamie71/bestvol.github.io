<?php

namespace App\Controller;
use App\Entity\Message;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(Request $request,EntityManagerInterface $entityManager): Response
    {
        $hello = null;

        $message= new Message();
        $form=$this->createForm(ContactType::class,$message);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()){   
    


            
          $entityManager->persist($message);
          $entityManager->flush();
          
          $hello = "Votre message a été reçu";
        }else{
           
        }
      





        return $this->render('contact/index.html.twig', [
            'form'=> $form->createView(),
            'hello' => $hello
        ]);
    }
}
