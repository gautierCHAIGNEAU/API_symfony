<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Rdv;
use App\Entity\Client;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class RdvController extends Controller{
//---------------MODIFICATION Rdv-----------------------------------
    /**
     * @Route("/Rdv/{id}")
     * @Method({"POST"})
     */
    public function RdvUpdate(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $rdv = $em->getRepository(Rdv::class)->find($id);

        $date = $request->get("date");
        $heure = $request->get("heure");
                        
        $rdv->setDate($date);
        $rdv->setHeure($heure);
            
        $em->flush();

        return new Response('', Response::HTTP_OK);
    }
    
    
//---------------AJOUT Rdv-----------------------------------    
    /**
     * @Route("/Rdv")
     * @Method({"POST"})
     */
    public function RdvInsert(Request $request)
    {
        $date = $request->get("date");
        $heure = $request->get("heure");
        $idClient = $request->get("client");
        
        $client = $this->getDoctrine()
        ->getRepository(Client::class)
        ->find($idClient);
        
        $em = $this->getDoctrine()->getManager();
            
        $rdv = new Rdv();
        
        $rdv->setDate(new \DateTime($date));
        $rdv->setHeure($heure);
        $rdv->setClient($client);

        $em->persist($rdv);

        $em->flush();
        
        return new Response('', Response::HTTP_CREATED);
    }
    
//---------------SELECT ON 1 Rdv-----------------------------------
    /**
     * @Route("/Rdv/{id}")
     * @Method({"GET"})
     */
    public function RdvSelect(Rdv $rdv)
    {
        $json = $this->get('jms_serializer')->serialize($rdv, 'json');

        $response = new Response($json);
        $response->headers->set("Content-Type", "application/json");

        return $response;
        
    }
    
//---------------SUPPRESSION Rdv-----------------------------------
    /**
     * @Route("/Rdv/{id}")
     * @Method({"DELETE"})
     */
    public function RdvDelete(Rdv $rdv)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($rdv);
        $em->flush();
        return new Response('', Response::HTTP_OK);
        
    }
    

    
//---------------SELECT ON ALL Rdv-----------------------------------   
    /**
     * @Route("/Rdv")
     * @Method({"GET"})
     */
    public function FactureSelectAll()
    {
       
        $rdv = $this->getDoctrine()->getrepository(Rdv::class)->findAll();
        $json = $this->get('jms_serializer')->serialize($rdv, 'json');

        $response = new Response($json);
        $response->headers->set("Content-Type", "application/json");

        return $response;
    }
}
