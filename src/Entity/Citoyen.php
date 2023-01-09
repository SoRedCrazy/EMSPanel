<?php

namespace App\Entity;

use App\Repository\CitoyenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;



#[ORM\Entity(repositoryClass: CitoyenRepository::class)]
#[Vich\Uploadable]
class Citoyen
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    
    #[Vich\UploadableField(mapping: 'avatar', fileNameProperty: 'imageName', size: 'imageSize')]
    private ?File $imageFile = null;

    #[ORM\Column(type: 'string')]
    private ?string $imageName = null;

    #[ORM\Column(type: 'integer')]
    private ?int $imageSize = null;
    
    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $updatedAt = null;


    #[ORM\Column(length: 255)]
    private ?string $Username = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateNaissance = null;

    #[ORM\Column]
    private ?int $Num_Telephone = null;

    #[ORM\Column(length: 255)]
    private ?string $sexe = null;

    #[ORM\Column]
    private ?int $taille = null;

    #[ORM\Column(length: 255)]
    private ?string $metier = null;

    #[ORM\Column(length: 10)]
    private ?string $GroupeSanguin = null;

    #[ORM\Column]
    private ?int $poids = null;

    #[ORM\Column]
    private ?int $NumeroUrgence = null;

    #[ORM\OneToMany(mappedBy: 'citoyen', targetEntity: Vente::class)]
    private Collection $vente;

    #[ORM\OneToMany(mappedBy: 'citoyen', targetEntity: Ordonnance::class)]
    private Collection $ordonnances;

    #[ORM\OneToMany(mappedBy: 'citoyen', targetEntity: Blessure::class)]
    private Collection $blessures;

    #[ORM\OneToMany(mappedBy: 'citoyen', targetEntity: Operation::class)]
    private Collection $operations;

    #[ORM\OneToMany(mappedBy: 'citoyen', targetEntity: Therapie::class)]
    private Collection $therapies;

    #[ORM\OneToMany(mappedBy: 'citoyen', targetEntity: RDV::class)]
    private Collection $rDVs;

    #[ORM\OneToMany(mappedBy: 'citoyen', targetEntity: Examen::class)]
    private Collection $examens;

    #[ORM\OneToMany(mappedBy: 'citoyen', targetEntity: Certificats::class)]
    private Collection $certificats;


    public function __construct()
    {
        $this->vente = new ArrayCollection();
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
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->Username;
    }

    public function setUsername(string $Username): self
    {
        $this->Username = $Username;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getNumTelephone(): ?int
    {
        return $this->Num_Telephone;
    }

    public function setNumTelephone(int $Num_Telephone): self
    {
        $this->Num_Telephone = $Num_Telephone;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getTaille(): ?int
    {
        return $this->taille;
    }

    public function setTaille(int $taille): self
    {
        $this->taille = $taille;

        return $this;
    }

    public function getMetier(): ?string
    {
        return $this->metier;
    }

    public function setMetier(string $metier): self
    {
        $this->metier = $metier;

        return $this;
    }

    public function getGroupeSanguin(): ?string
    {
        return $this->GroupeSanguin;
    }

    public function setGroupeSanguin(string $GroupeSanguin): self
    {
        $this->GroupeSanguin = $GroupeSanguin;

        return $this;
    }

    public function getPoids(): ?int
    {
        return $this->poids;
    }

    public function setPoids(int $poids): self
    {
        $this->poids = $poids;

        return $this;
    }

    public function getNumeroUrgence(): ?int
    {
        return $this->NumeroUrgence;
    }

    public function setNumeroUrgence(int $NumeroUrgence): self
    {
        $this->NumeroUrgence = $NumeroUrgence;

        return $this;
    }

    /**
     * @return Collection<int, Vente>
     */
    public function getVente(): Collection
    {
        return $this->vente;
    }

    public function addAgent(Vente $vente): self
    {
        if (!$this->vente->contains($vente)) {
            $this->vente->add($vente);
            $vente->setCitoyen($this);
        }

        return $this;
    }

    public function removeVente(Vente $vente): self
    {
        if ($this->vente->removeElement($vente)) {
            // set the owning side to null (unless already changed)
            if ($vente->getCitoyen() === $this) {
                $vente->setCitoyen(null);
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
            $ordonnance->setCitoyen($this);
        }

        return $this;
    }

    public function removeOrdonnance(Ordonnance $ordonnance): self
    {
        if ($this->ordonnances->removeElement($ordonnance)) {
            // set the owning side to null (unless already changed)
            if ($ordonnance->getCitoyen() === $this) {
                $ordonnance->setCitoyen(null);
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
            $blessure->setCitoyen($this);
        }

        return $this;
    }

    public function removeBlessure(Blessure $blessure): self
    {
        if ($this->blessures->removeElement($blessure)) {
            // set the owning side to null (unless already changed)
            if ($blessure->getCitoyen() === $this) {
                $blessure->setCitoyen(null);
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
            $operation->setCitoyen($this);
        }

        return $this;
    }

    public function removeOperation(Operation $operation): self
    {
        if ($this->operations->removeElement($operation)) {
            // set the owning side to null (unless already changed)
            if ($operation->getCitoyen() === $this) {
                $operation->setCitoyen(null);
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
            $therapy->setCitoyen($this);
        }

        return $this;
    }

    public function removeTherapy(Therapie $therapy): self
    {
        if ($this->therapies->removeElement($therapy)) {
            // set the owning side to null (unless already changed)
            if ($therapy->getCitoyen() === $this) {
                $therapy->setCitoyen(null);
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
            $rDV->setCitoyen($this);
        }

        return $this;
    }

    public function removeRDV(RDV $rDV): self
    {
        if ($this->rDVs->removeElement($rDV)) {
            // set the owning side to null (unless already changed)
            if ($rDV->getCitoyen() === $this) {
                $rDV->setCitoyen(null);
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
            $examen->setCitoyen($this);
        }

        return $this;
    }

    public function removeExamen(Examen $examen): self
    {
        if ($this->examens->removeElement($examen)) {
            // set the owning side to null (unless already changed)
            if ($examen->getCitoyen() === $this) {
                $examen->setCitoyen(null);
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
            $certificat->setCitoyen($this);
        }

        return $this;
    }

    public function removeCertificat(Certificats $certificat): self
    {
        if ($this->certificats->removeElement($certificat)) {
            // set the owning side to null (unless already changed)
            if ($certificat->getCitoyen() === $this) {
                $certificat->setCitoyen(null);
            }
        }

        return $this;
    }

}
