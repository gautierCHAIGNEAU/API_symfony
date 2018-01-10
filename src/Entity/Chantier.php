<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChantierRepository")
 */
class Chantier
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
     * @ORM\Column(type="date")
     */
    private $date;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $duree;
    
     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="chantiers")
     * @ORM\JoinColumn(nullable=true)
     */
    private $client;
    
        function getId() {
        return $this->id;
    }
    
    function getNom() {
        return $this->nom;
    }
    
    function getDate() {
        return $this->date;
    }

    function getDuree() {
        return $this->duree;
    }

    function setId($id) {
        $this->id = $id;
    }
    
    function setNom($nom) {
        $this->nom = $nom;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setDuree($duree) {
        $this->duree = $duree;
    }
    
    public function getClient()
    {
        return $this->client;
    }

    public function setClient(Client $client)
    {
        $this->client = $client;
    }
}
