<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RdvRepository")
 */
class Rdv
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $heure;
    
    function getId() {
        return $this->id;
    }

    function getDate() {
        return $this->date;
    }

    function getHeure() {
        return $this->heure;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setHeure($heure) {
        $this->heure = $heure;
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="rdvs")
     * @ORM\JoinColumn(nullable=true)
     */
    private $client;

    public function getClient()
    {
        return $this->client;
    }

    public function setClient(Client $client)
    {
        $this->client = $client;
    }
}
