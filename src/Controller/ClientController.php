<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Client;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class ClientController extends Controller{
    
//---------------MODIFICATION CLIENT-----------------------------------
    /**
     * @Route("/Client/{id}")
     * @Method({"POST"})
     */
    public function ClientUpdate(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $client = $em->getRepository(Client::class)->find($id);

        $nom = $request->get("nom");
        $prenom = $request->get("prenom");
        $adresse = $request->get("adresse");
                        
        $client->setNom($nom);
        $client->setPrenom($prenom);
        $client->setAdresse($adresse);
            
        $em->flush();

        return new Response('', Response::HTTP_OK);
    }
    
    
//---------------AJOUT CLIENT-----------------------------------    
    /**
     * @Route("/Client")
     * @Method({"POST"})
     */
    public function ClientInsert(Request $request)
    {
        $nom = $request->get("nom");
        $prenom = $request->get("prenom");
        $adresse = $request->get("adresse");
        
        $em = $this->getDoctrine()->getManager();
            
        $client = new Client();

        $client->setNom($nom);
        $client->setPrenom($prenom);
        $client->setAdresse($adresse);

        $em->persist($client);

        $em->flush();
        
        return new Response('', Response::HTTP_CREATED);
    }
    
//---------------SELECT ON 1 CLIENT-----------------------------------
    /**
     * @Route("/Client/{id}")
     * @Method({"GET"})
     */
    public function ClientSelect(Client $client)
    {
        $json = $this->get('jms_serializer')->serialize($client, 'json');

        $response = new Response($json);
        $response->headers->set("Content-Type", "application/json");

        return $response;
        
    }
    
//---------------SUPPRESSION CLIENT-----------------------------------
    /**
     * @Route("/Client/{id}")
     * @Method({"DELETE"})
     */
    public function ClientDelete(Client $client)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($client);
        $em->flush();
        return new Response('', Response::HTTP_OK);
        
    }
    

    
//---------------SELECT ON ALL CLIENTS-----------------------------------   
    /**
     * @Route("/Client")
     * @Method({"GET"})
     */
    public function ClientSelectAll()
    {
       
        $client = $this->getDoctrine()->getrepository(Client::class)->findAll();
        $json = $this->get('jms_serializer')->serialize($client, 'json');

        $response = new Response($json);
        $response->headers->set("Content-Type", "application/json");

        return $response;
    }
}
