<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="users")
 * @uniqueEntity("email")
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
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nama_depan;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nama_belakang;

    /**
     * @ORM\Column(type="string", length=30, unique=true)
     */
    private $nik;

     /**
     * @ORM\Column(type="string")
     */
    private $ktp;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNamaDepan(): ?string
    {
        return $this->nama_depan;
    }

    public function setNamaDepan(string $nama_depan): self
    {
        $this->nama_depan = $nama_depan;

        return $this;
    }

    public function getNamaBelakang(): ?string
    {
        return $this->nama_belakang;
    }

    public function setNamaBelakang(string $nama_belakang): self
    {
        $this->nama_belakang = $nama_belakang;

        return $this;
    }

    public function getNik(): ?string
    {
        return $this->nik;
    }

    public function setNik(string $nik): self
    {
        $this->nik = $nik;

        return $this;
    }

    public function getKtp()
    {
        return $this->ktp;
    }

    public function setKtp($ktp): self
    {
        $this->ktp = $ktp;

        return $this;
    }
}
