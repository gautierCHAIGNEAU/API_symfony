<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nom;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $prenom;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $adresse;
    
    function getId() {
        return $this->id;
    }

    function getNom() {
        return $this->nom;
    }

    function getPrenom() {
        return $this->prenom;
    }

    function getAdresse() {
        return $this->adresse;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rdv", mappedBy="client")
     */
    private $rdvs;
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Facture", mappedBy="client")
     */
    private $factures;
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Chantier", mappedBy="client")
     */
    private $chantiers;

    public function __construct()
    {
        $this->rdvs = new ArrayCollection();
        $this->factures = new ArrayCollection();
        $this->chantiers = new ArrayCollection();
    }

    /**
     * @return Collection|Rdv[]
     */
    public function getRdv()
    {
        return $this->rdvs;
    }
    

    /**
     * @return Collection|Facture[]
     */
    public function getFacture()
    {
        return $this->factures;
    }
    
    /**
     * @return Collection|Chantier[]
     */
    public function getChantier()
    {
        return $this->chantiers;
    }
}
