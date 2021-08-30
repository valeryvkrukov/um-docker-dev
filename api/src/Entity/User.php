<?php

namespace App\Entity;

use App\Repository\UserRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Security\User\JWTUserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`users`")
 */
#[ApiResource]
class User implements JWTUserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     * @Assert\Email(message = "The email '{{ value }}' is not a valid email.")
     */
    private string $email;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private string $login;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private string $password;

    /**
     * @ORM\Column(type="array")
     */
    private array $roles = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private array $rolesId = [];

    /**
     * @ORM\Column(type="boolean")
     * @Assert\NotBlank
     * @Assert\Type("bool")
     */
    private bool $isActive = false;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Your name cannot contain a number"
     * )
     */
    private ?string $firstName;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Your name cannot contain a number"
     * )
     */
    private ?string $lastName;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Choice({"en_US", "ru_RU"})
     */
    private ?string $language = 'ru_RU';

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime|null
     */
    private ?\DateTime $birthday;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Regex(pattern="/M|W/")
     * @var string|null
     */
    private ?string $gender;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Url
     *
     * @var string|null
     */
    private ?string $www;

    /**
     * @ORM\Column(type="text", nullable=true)
     *
     * @var string|null
     */
    private ?string $description;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @var string|null
     */
    private ?string $confirmCode;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @var string|null
     */
    private ?string $externalAuth;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @var string|null
     */
    private ?string $lid;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @var string|null
     */
    private ?string $externalAccountId;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank
     *
     */
    private \DateTime $registeredAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     */
    private ?\DateTime $lastLogin;

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
    public function getUserIdentifier(): string
    {
        return (string) $this->login;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return (string) $this->email;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return bool
     */
    public function getIsActive(): bool
    {
        return (bool) $this->isActive;
    }

    /**
     * @param bool $isActive
     * @return $this
     */
    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param array $roles
     * @return $this
     */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return array
     */
    public function getRolesId(): array
    {
        return $this->rolesId;
    }

    /**
     * @param array $rolesId
     */
    public function setRolesId(array $rolesId): void
    {
        $this->rolesId = $rolesId;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string|null $firstName
     * @return $this
     */
    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string|null $lastName
     * @return $this
     */
    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLanguage(): ?string
    {
        return $this->language;
    }

    /**
     * @param string $language
     * @return $this
     */
    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getBirthday(): ?\DateTime
    {
        return $this->birthday;
    }

    /**
     * @param \DateTime|null $birthday
     */
    public function setBirthday(?\DateTime $birthday): void
    {
        $this->birthday = $birthday;
    }

    /**
     * @return string|null
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * @param string|null $gender
     */
    public function setGender(?string $gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @return string|null
     */
    public function getWww(): ?string
    {
        return $this->www;
    }

    /**
     * @param string|null $www
     */
    public function setWww(?string $www): void
    {
        $this->www = $www;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string|null
     */
    public function getConfirmCode(): ?string
    {
        return $this->confirmCode;
    }

    /**
     * @param string|null $confirmCode
     */
    public function setConfirmCode(?string $confirmCode): void
    {
        $this->confirmCode = $confirmCode;
    }

    /**
     * @return string|null
     */
    public function getExternalAuth(): ?string
    {
        return $this->externalAuth;
    }

    /**
     * @param string|null $externalAuth
     */
    public function setExternalAuth(?string $externalAuth): void
    {
        $this->externalAuth = $externalAuth;
    }

    /**
     * @return string|null
     */
    public function getLid(): ?string
    {
        return $this->lid;
    }

    /**
     * @param string|null $lid
     */
    public function setLid(?string $lid): void
    {
        $this->lid = $lid;
    }

    /**
     * @return string|null
     */
    public function getExternalAccountId(): ?string
    {
        return $this->externalAccountId;
    }

    /**
     * @param string|null $externalAccountId
     */
    public function setExternalAccountId(?string $externalAccountId): void
    {
        $this->externalAccountId = $externalAccountId;
    }

    /**
     * @return \DateTime
     */
    public function getRegisteredAt(): \DateTime
    {
        return $this->registeredAt;
    }

    /**
     * @param \DateTime $registeredAt
     * @return $this
     */
    public function setRegisteredAt(\DateTime $registeredAt): self
    {
        $this->registeredAt = $registeredAt;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getLastLogin(): ?\DateTime
    {
        return $this->lastLogin;
    }

    /**
     * @param \DateTime|null $lastLogin
     * @return $this
     */
    public function setLastLogin(?\DateTime $lastLogin): self
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * The methods followed below aren't used at the moment
     * but must be implemented as they are defined in UserInterface
     */

    /**
     * @inheritDoc
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier() instead
     */
    public function getUsername(): ?string
    {
        return $this->getUserIdentifier();
    }

    /**
     * @inheritDoc
     */
    public static function createFromPayload($username, array $payload)
    {
        // TODO: Implement createFromPayload() method.
    }
}