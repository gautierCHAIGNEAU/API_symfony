<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class IndexController extends Controller
{
    /**
     * @Route("/")
     */
    public function accueil()
    {
        return $this->render('/Clients.html.twig', array(
           'Titre'=>"API Symfony"
        ));
    }  
    
    
    /**
     * @Route("/Clients")
     */
    public function lstClient()
    {
        return $this->render('/Clients.html.twig', array(
           'Titre'=>"API Symfony"
        ));
    }
    
    /**
     * @Route("/Nouveau-Client")
     */
    public function newClient()
    {
        return $this->render('/ajoutClient.html.twig', array(
           'Titre'=>"API Symfony"
        ));
    }
    
     /**
     * @Route("/Factures")
     */
    public function lstFactures()
    {
        return $this->render('/Factures.html.twig', array(
           'Titre'=>"API Symfony"
        ));
    }
    
    /**
     * @Route("/Nouveau-Facture")
     */
    public function newFacture()
    {
        return $this->render('/ajoutFacture.html.twig', array(
           'Titre'=>"API Symfony"
        ));
    }
    
    
    /**
     * @Route("/Rdvs")
     */
    public function lstRdv()
    {
        return $this->render('/Rdv.html.twig', array(
           'Titre'=>"API Symfony"
        ));
    }
    
    /**
     * @Route("/Nouveau-Rdv")
     */
    public function newRdv()
    {
        return $this->render('/ajoutRdv.html.twig', array(
           'Titre'=>"API Symfony"
        ));
    }
    
     /**
     * @Route("/Chantiers")
     */
    public function lstChantiers()
    {
        return $this->render('/Chantiers.html.twig', array(
           'Titre'=>"API Symfony"
        ));
    }
    
    /**
     * @Route("/Nouveau-Rdv")
     */
    public function newChantier()
    {
        return $this->render('/ajouterChantier.html.twig', array(
           'Titre'=>"API Symfony"
        ));
    }
}
