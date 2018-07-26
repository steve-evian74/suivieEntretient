<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieInterventionRepository")
 */
class CategorieIntervention
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TypeIntervention", mappedBy="fkTypeIntervention")
     */
    private $typeInterventions;

    public function __construct()
    {
        $this->typeInterventions = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|TypeIntervention[]
     */
    public function getTypeInterventions(): Collection
    {
        return $this->typeInterventions;
    }

    public function addTypeIntervention(TypeIntervention $typeIntervention): self
    {
        if (!$this->typeInterventions->contains($typeIntervention)) {
            $this->typeInterventions[] = $typeIntervention;
            $typeIntervention->setFkTypeIntervention($this);
        }

        return $this;
    }

    public function removeTypeIntervention(TypeIntervention $typeIntervention): self
    {
        if ($this->typeInterventions->contains($typeIntervention)) {
            $this->typeInterventions->removeElement($typeIntervention);
            // set the owning side to null (unless already changed)
            if ($typeIntervention->getFkTypeIntervention() === $this) {
                $typeIntervention->setFkTypeIntervention(null);
            }
        }

        return $this;
    }
}
