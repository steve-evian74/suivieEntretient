<?php
// /src/Entity/User.php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="user")
 * @UniqueEntity(fields="email", message="Email déjà pris")
 * @UniqueEntity(fields="username", message="Username déjà pris")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $fullName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", unique=true)
     * @Assert\NotBlank()
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(type="string", unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    private $typeRoles;
    
    /**
     * @var array
     *
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $codePostale;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $telFixe;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $telPortable;

    /**
     * @ORM\Column(type="string", length=15,  nullable=true)
     */
    private $numeroSiret;

    /**
     * @ORM\Column(type="string", length=255 , nullable=true)
     */
    private $logo;

    /**
     * @ORM\Column(type="text",  nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=25,  nullable=true)
     */
    private $nomEntreprise;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FicheVoiture", mappedBy="user")
     */
    private $fkVoiture;
    
    private $idSession;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Image", mappedBy="user")
     */
    private $fkImage; 

    public function __construct()
    {
        $this->fkVoiture = new ArrayCollection();
        $this->fkImage = new ArrayCollection();
    }

    
    public function getId(): int
    {
        return $this->id;
    }

    public function setFullName(string $fullName): void
    {
        $this->fullName = $fullName;
    }

    // le ? signifie que cela peur aussi retourner null
    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * Retourne les rôles de l'user
     */
    public function getRoles(): array
    {
        $roles = $this->roles;

        // Afin d'être sûr qu'un user a toujours au moins 1 rôle
        if (empty($roles)) {
            $roles[] = 'ROLE_USER';
        }

        return array_unique($roles);
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    /**
     * Retour le salt qui a servi à coder le mot de passe
     *
     * {@inheritdoc}
     */
    public function getSalt(): ?string
    {
        // See "Do you need to use a Salt?" at https://symfony.com/doc/current/cookbook/security/entity_provider.html
        // we're using bcrypt in security.yml to encode the password, so
        // the salt value is built-in and you don't have to generate one

        return null;
    }

    /**
     * Removes sensitive data from the user.
     *
     * {@inheritdoc}
     */
    public function eraseCredentials(): void
    {
        // Nous n'avons pas besoin de cette methode car nous n'utilions pas de plainPassword
        // Mais elle est obligatoire car comprise dans l'interface UserInterface
        // $this->plainPassword = null;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize(): string
    {
        return serialize([$this->id, $this->username, $this->password]);
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($serialized): void
    {
        [$this->id, $this->username, $this->password] = unserialize($serialized, ['allowed_classes' => false]);
    }
    
       /**
     * Retourne les rôles de l'user
     */
    public function getTypeRoles()
    {
        $typeRoles = $this->typeRoles;
        return $typeRoles;
    }

    public function setTypeRoles($typeRoles): void
    {
        $this->typeRoles = $typeRoles;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodePostale(): ?string
    {
        return $this->codePostale;
    }

    public function setCodePostale(string $codePostale): self
    {
        $this->codePostale = $codePostale;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getTelFixe(): ?string
    {
        return $this->telFixe;
    }

    public function setTelFixe(string $telFixe): self
    {
        $this->telFixe = $telFixe;

        return $this;
    }

    public function getTelPortable(): ?string
    {
        return $this->telPortable;
    }

    public function setTelPortable(string $telPortable): self
    {
        $this->telPortable = $telPortable;

        return $this;
    }

    public function getNumeroSiret(): ?string
    {
        return $this->numeroSiret;
    }

    public function setNumeroSiret(string $numeroSiret): self
    {
        $this->numeroSiret = $numeroSiret;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

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

    public function getNomEntreprise(): ?string
    {
        return $this->nomEntreprise;
    }

    public function setNomEntreprise(string $nomEntreprise): self
    {
        $this->nomEntreprise = $nomEntreprise;

        return $this;
    }

    /**
     * @return Collection|FicheVoiture[]
     */
    public function getFkVoiture(): Collection
    {
        return $this->fkVoiture;
    }

    public function addFkVoiture(FicheVoiture $fkVoiture): self
    {
        if (!$this->fkVoiture->contains($fkVoiture)) {
            $this->fkVoiture[] = $fkVoiture;
            $fkUser->setUser($this);
        }

        return $this;
    }

    public function removeFkVoiture(FicheVoiture $FkVoiture): self
    {
        if ($this->fkVoiture->contains($fkVoiture)) {
            $this->fkVoiture->removeElement($fkVoiture);
            // set the owning side to null (unless already changed)
            if ($fkUser->getUser() === $this) {
                $fkUser->setUser(null);
            }
        }

        return $this;
    }
    
    
    public function getIdSession(): ?string
    {
        return $this->idSession;
    }

    public function setIdSession(string $idSession): void
    {
        $this->idSession = $idSession;
    }

    /**
     * @return Collection|Image[]
     */
    public function getFkImage(): Collection
    {
        return $this->fkImage;
    }

    public function addFkImage(Image $fkImage): self
    {
        if (!$this->fkImage->contains($fkImage)) {
            $this->fkImage[] = $fkImage;
            $fkImage->setUser($this);
        }

        return $this;
    }

    public function removeFkImage(Image $fkImage): self
    {
        if ($this->fkImage->contains($fkImage)) {
            $this->fkImage->removeElement($fkImage);
            // set the owning side to null (unless already changed)
            if ($fkImage->getUser() === $this) {
                $fkImage->setUser(null);
            }
        }

        return $this;
    }
    
}