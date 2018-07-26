<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarnetEntretienRepository")
 */
class CarnetEntretien
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateIntervention;

    /**
     * @ORM\Column(type="integer")
     */
    private $kilometre;

    /**
     * @ORM\Column(type="text")
     */
    private $commentaireIntervention;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FicheVoiture", inversedBy="fkFicheVoiture")
     */
    private $ficheVoiture;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AvisIntervention", mappedBy="carnetEntretien")
     */
    private $fkCarnetEntretien;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeIntervention", inversedBy="fkTypeInterventionCarnet")
     */
    private $typeIntervention;



    public function __construct()
    {
        $this->fkCarnetEntretien = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDateIntervention(): ?\DateTimeInterface
    {
        return $this->dateIntervention;
    }

    public function setDateIntervention(\DateTimeInterface $dateIntervention): self
    {
        $this->dateIntervention = $dateIntervention;

        return $this;
    }

    public function getKilometre(): ?int
    {
        return $this->kilometre;
    }

    public function setKilometre(int $kilometre): self
    {
        $this->kilometre = $kilometre;

        return $this;
    }

    public function getCommentaireIntervention(): ?string
    {
        return $this->commentaireIntervention;
    }

    public function setCommentaireIntervention(string $commentaireIntervention): self
    {
        $this->commentaireIntervention = $commentaireIntervention;

        return $this;
    }

    public function getFicheVoiture(): ?FicheVoiture
    {
        return $this->ficheVoiture;
    }

    public function setFicheVoiture(?FicheVoiture $ficheVoiture): self
    {
        $this->ficheVoiture = $ficheVoiture;

        return $this;
    }

    /**
     * @return Collection|AvisIntervention[]
     */
    public function getFkCarnetEntretien(): Collection
    {
        return $this->fkCarnetEntretien;
    }

    public function addFkCarnetEntretien(AvisIntervention $fkCarnetEntretien): self
    {
        if (!$this->fkCarnetEntretien->contains($fkCarnetEntretien)) {
            $this->fkCarnetEntretien[] = $fkCarnetEntretien;
            $fkCarnetEntretien->setCarnetEntretien($this);
        }

        return $this;
    }

    public function removeFkCarnetEntretien(AvisIntervention $fkCarnetEntretien): self
    {
        if ($this->fkCarnetEntretien->contains($fkCarnetEntretien)) {
            $this->fkCarnetEntretien->removeElement($fkCarnetEntretien);
            // set the owning side to null (unless already changed)
            if ($fkCarnetEntretien->getCarnetEntretien() === $this) {
                $fkCarnetEntretien->setCarnetEntretien(null);
            }
        }

        return $this;
    }

    public function getTypeIntervention(): ?TypeIntervention
    {
        return $this->typeIntervention;
    }

    public function setTypeIntervention(?TypeIntervention $typeIntervention): self
    {
        $this->typeIntervention = $typeIntervention;

        return $this;
    }

    


}
