<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeInterventionRepository")
 */
class TypeIntervention
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
     * @ORM\ManyToOne(targetEntity="App\Entity\CategorieIntervention", inversedBy="typeInterventions")
     */
    private $fkCategorieIntervention;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CarnetEntretien", mappedBy="typeIntervention")
     */
    private $fkTypeInterventionCarnet;

    public function __construct()
    {
        $this->fkTypeInterventionCarnet = new ArrayCollection();
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


    public function getFkCategorieIntervention(): ?CategorieIntervention
    {
        return $this->fkTypeIntervention;
    }

    public function setFkCategorieIntervention(?CategorieIntervention $fkCategorieIntervention): self
    {
        $this->fkCategorieIntervention = $fkCategorieIntervention;

        return $this;
    }

    /**
     * @return Collection|CarnetEntretien[]
     */
    public function getFkTypeInterventionCarnet(): Collection
    {
        return $this->fkTypeInterventionCarnet;
    }

    public function addFkTypeInterventionCarnet(CarnetEntretien $fkTypeInterventionCarnet): self
    {
        if (!$this->fkTypeInterventionCarnet->contains($fkTypeInterventionCarnet)) {
            $this->fkTypeInterventionCarnet[] = $fkTypeInterventionCarnet;
            $fkTypeInterventionCarnet->setTypeIntervention($this);
        }

        return $this;
    }

    public function removeFkTypeInterventionCarnet(CarnetEntretien $fkTypeInterventionCarnet): self
    {
        if ($this->fkTypeInterventionCarnet->contains($fkTypeInterventionCarnet)) {
            $this->fkTypeInterventionCarnet->removeElement($fkTypeInterventionCarnet);
            // set the owning side to null (unless already changed)
            if ($fkTypeInterventionCarnet->getTypeIntervention() === $this) {
                $fkTypeInterventionCarnet->setTypeIntervention(null);
            }
        }

        return $this;
    }
}
