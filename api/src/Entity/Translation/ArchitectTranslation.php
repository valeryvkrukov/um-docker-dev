<?php

namespace App\Entity\Translation;


use App\Behavior\TranslationTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Knp\DoctrineBehaviors\Contract\Entity\TranslationInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class ArchitectTranslation implements TranslationInterface
{
    use TranslationTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", unique=true)
     * @Assert\NotBlank
     * @Groups({"read", "write"})
     */
    private string $name;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     * @Groups({"read", "write"})
     */
    private string $description;

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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}