<?php

namespace App\Entity;

use App\Repository\ImagesConsolesMiniRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImagesConsolesMiniRepository::class)
 */
class ImagesConsolesMini
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=ConsolesMinis::class, inversedBy="imagesConsolesMinis")
     * @ORM\JoinColumn(nullable=false)
     */
    private $consolesminis;

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

    public function getConsolesminis(): ?ConsolesMinis
    {
        return $this->consolesminis;
    }

    public function setConsolesminis(?ConsolesMinis $consolesminis): self
    {
        $this->consolesminis = $consolesminis;

        return $this;
    }
}
