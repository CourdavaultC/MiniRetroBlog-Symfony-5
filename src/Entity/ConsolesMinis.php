<?php

namespace App\Entity;

use App\Repository\ConsolesMinisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConsolesMinisRepository::class)
 */
class ConsolesMinis
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $manufacturer;

    /**
     * @ORM\Column(type="integer")
     */
    private $new_price;

    /**
     * @ORM\Column(type="integer")
     */
    private $used_price;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="datetime")
     */
    private $manufactured_date;

    /**
     * @ORM\OneToMany(targetEntity=ImagesConsolesMini::class, mappedBy="consolesminis", orphanRemoval=true, cascade={"persist"})
     */
    private $imagesConsolesMinis;

    public function __construct()
    {
        $this->imagesConsolesMinis = new ArrayCollection();
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

    public function getManufacturer(): ?string
    {
        return $this->manufacturer;
    }

    public function setManufacturer(string $manufacturer): self
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    public function getNewPrice(): ?int
    {
        return $this->new_price;
    }

    public function setNewPrice(int $new_price): self
    {
        $this->new_price = $new_price;

        return $this;
    }

    public function getUsedPrice(): ?int
    {
        return $this->used_price;
    }

    public function setUsedPrice(int $used_price): self
    {
        $this->used_price = $used_price;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getManufacturedDate(): ?\DateTimeInterface
    {
        return $this->manufactured_date;
    }

    public function setManufacturedDate(\DateTimeInterface $manufactured_date): self
    {
        $this->manufactured_date = $manufactured_date;

        return $this;
    }

    /**
     * @return Collection|ImagesConsolesMini[]
     */
    public function getImagesConsolesMinis(): Collection
    {
        return $this->imagesConsolesMinis;
    }

    public function addImagesConsolesMini(ImagesConsolesMini $imagesConsolesMini): self
    {
        if (!$this->imagesConsolesMinis->contains($imagesConsolesMini)) {
            $this->imagesConsolesMinis[] = $imagesConsolesMini;
            $imagesConsolesMini->setConsolesminis($this);
        }

        return $this;
    }

    public function removeImagesConsolesMini(ImagesConsolesMini $imagesConsolesMini): self
    {
        if ($this->imagesConsolesMinis->removeElement($imagesConsolesMini)) {
            // set the owning side to null (unless already changed)
            if ($imagesConsolesMini->getConsolesminis() === $this) {
                $imagesConsolesMini->setConsolesminis(null);
            }
        }

        return $this;
    }
}
