<?php

namespace App\Entity;

use App\Repository\AgentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: AgentRepository::class)]
#[Vich\Uploadable]
#[UniqueEntity(fields: ['username'], message: 'Username déjà prit')]
class Agent implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[Vich\UploadableField(mapping: 'avatar', fileNameProperty: 'imageName', size: 'imageSize')]
    private ?File $imageFile = null;

    #[ORM\Column(type: 'string')]
    private ?string $imageName = null;

    #[ORM\Column(type: 'integer')]
    private ?int $imageSize = null;
    
    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\Column]
    private ?int $Num_telephone = null;

    #[ORM\Column]
    private ?bool $actif = null;

    #[ORM\OneToMany(mappedBy: 'agent', targetEntity: Vente::class)]
    private Collection $ventes;

    #[ORM\OneToMany(mappedBy: 'agent', targetEntity: Ordonnance::class)]
    private Collection $ordonnances;

    #[ORM\OneToMany(mappedBy: 'agent', targetEntity: Blessure::class)]
    private Collection $blessures;

    #[ORM\OneToMany(mappedBy: 'agent', targetEntity: Operation::class)]
    private Collection $operations;

    #[ORM\OneToMany(mappedBy: 'agent', targetEntity: Therapie::class)]
    private Collection $therapies;

    #[ORM\OneToMany(mappedBy: 'agent', targetEntity: RDV::class)]
    private Collection $rDVs;

    #[ORM\OneToMany(mappedBy: 'agent', targetEntity: Examen::class)]
    private Collection $examens;

    #[ORM\OneToMany(mappedBy: 'agent', targetEntity: Certificats::class)]
    private Collection $certificats;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        if(sizeof($this->roles)==0){
        $roles[] = 'ROLE_INFERMIER';
        }
        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function __construct()
    {
        $this->actif=false;
        $this->ventes = new ArrayCollection();
        $this->ordonnances = new ArrayCollection();
        $this->blessures = new ArrayCollection();
        $this->operations = new ArrayCollection();
        $this->therapies = new ArrayCollection();
        $this->rDVs = new ArrayCollection();
        $this->examens = new ArrayCollection();
        $this->certificats = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getUsername();
    }
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }
    public function getNumTelephone(): ?int
    {
        return $this->Num_telephone;
    }

    public function setNumTelephone(int $Num_telephone): self
    {
        $this->Num_telephone = $Num_telephone;

        return $this;
    }

    public function isActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }
 
     /**
      * @return string
      */
     public function getUpdatedAt()
     {
         return $this->updatedAt;
     }
 
     /**
      * @param string $updatedAt
      */
     public function setUpdatedAt($updatedAt)
     {
         $this->updatedAt = $updatedAt;
     }

     /**
      * @return Collection<int, Vente>
      */
     public function getVentes(): Collection
     {
         return $this->ventes;
     }

     public function addVente(Vente $vente): self
     {
         if (!$this->ventes->contains($vente)) {
             $this->ventes->add($vente);
             $vente->setAgent($this);
         }

         return $this;
     }

     public function removeVente(Vente $vente): self
     {
         if ($this->ventes->removeElement($vente)) {
             // set the owning side to null (unless already changed)
             if ($vente->getAgent() === $this) {
                 $vente->setAgent(null);
             }
         }

         return $this;
     }

     /**
      * @return Collection<int, Ordonnance>
      */
     public function getOrdonnances(): Collection
     {
         return $this->ordonnances;
     }

     public function addOrdonnance(Ordonnance $ordonnance): self
     {
         if (!$this->ordonnances->contains($ordonnance)) {
             $this->ordonnances->add($ordonnance);
             $ordonnance->setAgent($this);
         }

         return $this;
     }

     public function removeOrdonnance(Ordonnance $ordonnance): self
     {
         if ($this->ordonnances->removeElement($ordonnance)) {
             // set the owning side to null (unless already changed)
             if ($ordonnance->getAgent() === $this) {
                 $ordonnance->setAgent(null);
             }
         }

         return $this;
     }

     /**
      * @return Collection<int, Blessure>
      */
     public function getBlessures(): Collection
     {
         return $this->blessures;
     }

     public function addBlessure(Blessure $blessure): self
     {
         if (!$this->blessures->contains($blessure)) {
             $this->blessures->add($blessure);
             $blessure->setAgent($this);
         }

         return $this;
     }

     public function removeBlessure(Blessure $blessure): self
     {
         if ($this->blessures->removeElement($blessure)) {
             // set the owning side to null (unless already changed)
             if ($blessure->getAgent() === $this) {
                 $blessure->setAgent(null);
             }
         }

         return $this;
     }

     /**
      * @return Collection<int, Operation>
      */
     public function getOperations(): Collection
     {
         return $this->operations;
     }

     public function addOperation(Operation $operation): self
     {
         if (!$this->operations->contains($operation)) {
             $this->operations->add($operation);
             $operation->setAgent($this);
         }

         return $this;
     }

     public function removeOperation(Operation $operation): self
     {
         if ($this->operations->removeElement($operation)) {
             // set the owning side to null (unless already changed)
             if ($operation->getAgent() === $this) {
                 $operation->setAgent(null);
             }
         }

         return $this;
     }

     /**
      * @return Collection<int, Therapie>
      */
     public function getTherapies(): Collection
     {
         return $this->therapies;
     }

     public function addTherapy(Therapie $therapy): self
     {
         if (!$this->therapies->contains($therapy)) {
             $this->therapies->add($therapy);
             $therapy->setAgent($this);
         }

         return $this;
     }

     public function removeTherapy(Therapie $therapy): self
     {
         if ($this->therapies->removeElement($therapy)) {
             // set the owning side to null (unless already changed)
             if ($therapy->getAgent() === $this) {
                 $therapy->setAgent(null);
             }
         }

         return $this;
     }

     /**
      * @return Collection<int, RDV>
      */
     public function getRDVs(): Collection
     {
         return $this->rDVs;
     }

     public function addRDV(RDV $rDV): self
     {
         if (!$this->rDVs->contains($rDV)) {
             $this->rDVs->add($rDV);
             $rDV->setAgent($this);
         }

         return $this;
     }

     public function removeRDV(RDV $rDV): self
     {
         if ($this->rDVs->removeElement($rDV)) {
             // set the owning side to null (unless already changed)
             if ($rDV->getAgent() === $this) {
                 $rDV->setAgent(null);
             }
         }

         return $this;
     }

     /**
      * @return Collection<int, Examen>
      */
     public function getExamens(): Collection
     {
         return $this->examens;
     }

     public function addExamen(Examen $examen): self
     {
         if (!$this->examens->contains($examen)) {
             $this->examens->add($examen);
             $examen->setAgent($this);
         }

         return $this;
     }

     public function removeExamen(Examen $examen): self
     {
         if ($this->examens->removeElement($examen)) {
             // set the owning side to null (unless already changed)
             if ($examen->getAgent() === $this) {
                 $examen->setAgent(null);
             }
         }

         return $this;
     }

     /**
      * @return Collection<int, Certificats>
      */
     public function getCertificats(): Collection
     {
         return $this->certificats;
     }

     public function addCertificat(Certificats $certificat): self
     {
         if (!$this->certificats->contains($certificat)) {
             $this->certificats->add($certificat);
             $certificat->setAgent($this);
         }

         return $this;
     }

     public function removeCertificat(Certificats $certificat): self
     {
         if ($this->certificats->removeElement($certificat)) {
             // set the owning side to null (unless already changed)
             if ($certificat->getAgent() === $this) {
                 $certificat->setAgent(null);
             }
         }

         return $this;
     }
}
