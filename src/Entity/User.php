<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Table(name="user");
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(name="username",type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(name="password",type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(name="created_at",type="datetimetz")
     */
    private $createdAt;

    /**
     * @ORM\Column(name="updated_at",type="datetimetz")
     */
    private $updatedAt;

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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedDate(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdateDate(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdateDate(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getRoles(){
        return [];
    }

    public function getSalt() {}

    public function eraseCredentials() {}



}
