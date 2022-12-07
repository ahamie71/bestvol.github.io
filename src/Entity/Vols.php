<?php

namespace App\Entity;

use App\Repository\VolsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VolsRepository::class)]
class Vols
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $depart = null;

    #[ORM\Column(length: 255)]
    private ?string $destination = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datederetour = null;

    #[ORM\Column]
    private ?float $tarif = null;

    #[ORM\ManyToOne(inversedBy: 'vols')]
    private ?Company $idCompany = null;

    #[ORM\OneToMany(mappedBy: 'idVols', targetEntity: Achat::class)]
    private Collection $achats;

    public function __construct()
    {
        $this->achats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDepart(): ?\DateTimeInterface
    {
        return $this->depart;
    }

    public function setDepart(\DateTimeInterface $depart): self
    {
        $this->depart = $depart;

        return $this;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setDestination(string $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getDatederetour(): ?\DateTimeInterface
    {
        return $this->datederetour;
    }

    public function setDatederetour(\DateTimeInterface $datederetour): self
    {
        $this->datederetour = $datederetour;

        return $this;
    }

    public function getTarif(): ?float
    {
        return $this->tarif;
    }

    public function setTarif(float $tarif): self
    {
        $this->tarif = $tarif;

        return $this;
    }

    public function getIdCompany(): ?Company
    {
        return $this->idCompany;
    }

    public function setIdCompany(?Company $idCompany): self
    {
        $this->idCompany = $idCompany;

        return $this;
    }

    /**
     * @return Collection<int, Achat>
     */
    public function getAchats(): Collection
    {
        return $this->achats;
    }

    public function addAchat(Achat $achat): self
    {
        if (!$this->achats->contains($achat)) {
            $this->achats->add($achat);
            $achat->setIdVols($this);
        }

        return $this;
    }

    public function removeAchat(Achat $achat): self
    {
        if ($this->achats->removeElement($achat)) {
            // set the owning side to null (unless already changed)
            if ($achat->getIdVols() === $this) {
                $achat->setIdVols(null);
            }
        }

        return $this;
    }
}
