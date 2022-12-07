<?php

namespace App\Controller;
use App\Entity\Vols;
use App\Form\VolsType;
use App\Repository\CompanyRepository;
use App\Repository\VolsRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VolsController extends AbstractController

{
   


    #[Route('/vols/index', name: 'vols')]
    public function index(CompanyRepository $companyRepo, VolsRepository $volsRepo ,Request $request): Response
    {
        
       
       //on cree une instance de la classe vols 
          $vols= new Vols();

          //on cree le formulaire qui se base sur l'entité vols nommé VolsType
          $form=$this->createForm(VolsType::class,$vols);

          //handleRequest y va analyser , si il 'yaura une  reponse ou pas 
          $form->handleRequest($request);


           // si le fomulaire est soumi et validé 
          if ($form->isSubmitted() && $form->isValid()){   
             
            //instance =formulaire = get data 
             $vols=$form->getdata();

            //on declare recherche qui appliquer la fonction creée dan de repository 
           
           $recherche=$volsRepo->findAllVolsBysearch($vols);

          //die and dump pour afficher la recherche
           dd($recherche);
           
        }
           
        // dans le return y va retourner le form  et la recherche vers la vue , voir dans la template de vols 
        return $this->render('vols/index.html.twig', [
            'form' => $form->createView(),
            // 'recherche' => $recherche
        ]);
      
 
        
    }}



    

    
//     #[Route('/vols/rechercherajax', name: 'vols/rechercherajax')]
//     public function rechercherajax(Request $request,EntityManagerInterface $entityManager):JsonResponse
//     {
       

//         $vols =$entityManager->getRepository(Vols::class)->findAll();
//       //die and dump (affichage du vols)
//        //dd($vols);
//         $jsonData =[]; 
//         $idx = 0;  
//         foreach($vols as $vols) {  
//            $jsonData[]=[
//               'id' =>$vols->getid(),
//               'depart' => $vols->getdepart(),
//               'destination'=> $vols->getdestination(), 
//               'datederetour' => $vols->getdatederetour(),
//               'tarif' => $vols->gettarif(),
//               'idCompany' => $vols->getidCompany()->getName(),
               
//            ];
           
            
           
//         } 
        
//         return new JsonResponse($jsonData);
        
           
//       }
       

// }

    
