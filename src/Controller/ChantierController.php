<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Chantier;
use App\Entity\Client;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class ChantierController extends Controller{
   //---------------MODIFICATION Chantier-----------------------------------
    /**
     * @Route("/Chantier/{id}")
     * @Method({"POST"})
     */
    public function ChantierUpdate(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $chantier = $em->getRepository(Chantier::class)->find($id);
        
        $nom = $request->get("nom");
        $date = new \DateTime($request->get("date"));
        $duree = $request->get("duree");
                        
        $chantier->setNom($nom);
        $chantier->setDate($date);
        $chantier->setDuree($duree);
            
        $em->flush();

        return new Response('', Response::HTTP_OK);
    }
    
    
//---------------AJOUT Chantier-----------------------------------    
    /**
     * @Route("/Chantier")
     * @Method({"POST"})
     */
    public function ChantierInsert(Request $request)
    {
        $nom = $request->get("nom");
        $date = $request->get("date");
        $duree = $request->get("duree");
        $idClient = $request->get("client");
        
        $client = $this->getDoctrine()
        ->getRepository(Client::class)
        ->find($idClient);
        
        $em = $this->getDoctrine()->getManager();
            
        $chantier = new Chantier();
        
        $chantier->setNom($nom);
        $chantier->setDate(new \DateTime($date));
        $chantier->setDuree($duree);
        $chantier->setClient($client);

        $em->persist($chantier);

        $em->flush();
        
        return new Response('', Response::HTTP_CREATED);
    }
    
//---------------SELECT ON 1 Chantier-----------------------------------
    /**
     * @Route("/Chantier/{id}")
     * @Method({"GET"})
     */
    public function ChantierSelect(Chantier $chantier)
    {
        $json = $this->get('jms_serializer')->serialize($chantier, 'json');

        $response = new Response($json);
        $response->headers->set("Content-Type", "application/json");

        return $response;
        
    }
    
//---------------SUPPRESSION Chantier-----------------------------------
    /**
     * @Route("/Chantier/{id}")
     * @Method({"DELETE"})
     */
    public function ChantierDelete(Chantier $chantier)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($chantier);
        $em->flush();
        return new Response('', Response::HTTP_OK);
        
    }
    

    
//---------------SELECT ON ALL Chantier-----------------------------------   
    /**
     * @Route("/Chantier")
     * @Method({"GET"})
     */
    public function ChantierSelectAll()
    {
       
        $rdv = $this->getDoctrine()->getrepository(Chantier::class)->findAll();
        $json = $this->get('jms_serializer')->serialize($rdv, 'json');

        $response = new Response($json);
        $response->headers->set("Content-Type", "application/json");

        return $response;
    }
}
