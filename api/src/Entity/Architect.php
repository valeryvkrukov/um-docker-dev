<?php

namespace App\Entity;

use App\Repository\ArchitectRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Behavior\TranslatableTrait;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ArchitectRepository::class)
 * @ORM\Table(name="`architects`")
 */
#[ApiResource]
class Architect implements TranslatableInterface
{
    use TranslatableTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read"})
     */
    private ?int $id = null;

    /**
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", unique=true)
     * @Assert\NotBlank
     */
    private string $slug;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }
}