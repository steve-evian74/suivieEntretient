<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AvisInterventionRepository")
 */
class AvisIntervention
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $commentaire;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $note;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CarnetEntretien", inversedBy="fkCarnetEntretien")
     */
    private $carnetEntretien;

    public function getId()
    {
        return $this->id;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(string $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getCarnetEntretien(): ?CarnetEntretien
    {
        return $this->carnetEntretien;
    }

    public function setCarnetEntretien(?CarnetEntretien $carnetEntretien): self
    {
        $this->carnetEntretien = $carnetEntretien;

        return $this;
    }
}
