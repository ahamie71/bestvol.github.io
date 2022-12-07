<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompanyRepository::class)]
class Company
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\OneToMany(mappedBy: 'idCompany', targetEntity: Vols::class)]
    private Collection $vols;

    public function __construct()
    {
        $this->vols = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection<int, Vols>
     */
    public function getVols(): Collection
    {
        return $this->vols;
    }

    public function addVol(Vols $vol): self
    {
        if (!$this->vols->contains($vol)) {
            $this->vols->add($vol);
            $vol->setIdCompany($this);
        }

        return $this;
    }

    public function removeVol(Vols $vol): self
    {
        if ($this->vols->removeElement($vol)) {
            // set the owning side to null (unless already changed)
            if ($vol->getIdCompany() === $this) {
                $vol->setIdCompany(null);
            }
        }

        return $this;
    }
}
