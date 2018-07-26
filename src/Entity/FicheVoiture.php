<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FicheVoitureRepository")
 */
class FicheVoiture
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $immatriculation;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $marque;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $modele;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $energie;

    /**
     * @ORM\Column(type="integer")
     */
    private $cvFiscale;

    /**
     * @ORM\Column(type="integer")
     */
    private $cvDigne;

    /**
     * @ORM\Column(type="date")
     */
    private $annee;

    /**
     * @ORM\Column(type="boolean")
     */
    private $vente;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CarnetEntretien", mappedBy="ficheVoiture")
     */
    private $fkFicheVoiture;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="fkUser")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $kilometre;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    public function __construct()
    {
        $this->fkFicheVoiture = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getImmatriculation(): ?string
    {
        return $this->immatriculation;
    }

    public function setImmatriculation(string $immatriculation): self
    {
        $this->immatriculation = $immatriculation;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getEnergie(): ?string
    {
        return $this->energie;
    }

    public function setEnergie(string $energie): self
    {
        $this->energie = $energie;

        return $this;
    }

    public function getCvFiscale(): ?int
    {
        return $this->cvFiscale;
    }

    public function setCvFiscale(int $cvFiscale): self
    {
        $this->cvFiscale = $cvFiscale;

        return $this;
    }

    public function getCvDigne(): ?int
    {
        return $this->cvDigne;
    }

    public function setCvDigne(int $cvDigne): self
    {
        $this->cvDigne = $cvDigne;

        return $this;
    }

    public function getAnnee(): ?\DateTimeInterface
    {
        return $this->annee;
    }

    public function setAnnee(\DateTimeInterface $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getVente(): ?bool
    {
        return $this->vente;
    }

    public function setVente(bool $vente): self
    {
        $this->vente = $vente;

        return $this;
    }


    /**
     * @return Collection|CarnetEntretien[]
     */
    public function getFkFicheVoiture(): Collection
    {
        return $this->fkFicheVoiture;
    }

    public function addFkFicheVoiture(CarnetEntretien $fkFicheVoiture): self
    {
        if (!$this->fkFicheVoiture->contains($fkFicheVoiture)) {
            $this->fkFicheVoiture[] = $fkFicheVoiture;
            $fkFicheVoiture->setFicheVoiture($this);
        }

        return $this;
    }

    public function removeFkFicheVoiture(CarnetEntretien $fkFicheVoiture): self
    {
        if ($this->fkFicheVoiture->contains($fkFicheVoiture)) {
            $this->fkFicheVoiture->removeElement($fkFicheVoiture);
            // set the owning side to null (unless already changed)
            if ($fkFicheVoiture->getFicheVoiture() === $this) {
                $fkFicheVoiture->setFicheVoiture(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getKilometre(): ?string
    {
        return $this->kilometre;
    }

    public function setKilometre(string $kilometre): self
    {
        $this->kilometre = $kilometre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
