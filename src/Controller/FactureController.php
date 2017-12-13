<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Facture;
use App\Entity\Client;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class FactureController extends Controller{
//---------------MODIFICATION Facture-----------------------------------
    /**
     * @Route("/Facture/{id}")
     * @Method({"POST"})
     */
    public function FactureUpdate(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $facture = $em->getRepository(Facture::class)->find($id);

        $prix = $request->get("prix");
                        
        $facture->setPrix($prix);
            
        $em->flush();

        return new Response('', Response::HTTP_OK);
    }
    
    
//---------------AJOUT Facture-----------------------------------    
    /**
     * @Route("/Facture")
     * @Method({"POST"})
     */
    public function FactureInsert(Request $request)
    {
        $prix = $request->get("prix");
        $idClient = $request->get("client");
        
        $client = $this->getDoctrine()
        ->getRepository(Client::class)
        ->find($idClient);
        
        $em = $this->getDoctrine()->getManager();
            
        $facture = new Facture();

        $facture->setPrix($prix);
        $facture->setClient($client);

        $em->persist($facture);

        $em->flush();
        
        return new Response('', Response::HTTP_CREATED);
    }
    
//---------------SELECT ON 1 Facture-----------------------------------
    /**
     * @Route("/Facture/{id}")
     * @Method({"GET"})
     */
    public function FactureSelect(Facture $facture)
    {
        $json = $this->get('jms_serializer')->serialize($facture, 'json');

        $response = new Response($json);
        $response->headers->set("Content-Type", "application/json");

        return $response;
        
    }
    
//---------------SUPPRESSION Facture-----------------------------------
    /**
     * @Route("/Facture/{id}")
     * @Method({"DELETE"})
     */
    public function FactureDelete(Facture $facture)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($facture);
        $em->flush();
        return new Response('', Response::HTTP_OK);
        
    }
    

    
//---------------SELECT ON ALL Facture-----------------------------------   
    /**
     * @Route("/Facture")
     * @Method({"GET"})
     */
    public function FactureSelectAll()
    {
       
        $facture = $this->getDoctrine()->getrepository(Facture::class)->findAll();
        $json = $this->get('jms_serializer')->serialize($facture, 'json');

        $response = new Response($json);
        $response->headers->set("Content-Type", "application/json");

        return $response;
    }
}
