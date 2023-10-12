<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


#[UniqueEntity('email',message:"Ce contact existe déja")]
#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank(message:"Le prénom est obligatoire")]
    #[Assert\Length(
        max: 255,
        maxMessage: 'Le prénom ne doit dépasser {{ limit }} caractéres.',
    )]
    #[Assert\Regex(
        pattern: "/^[0-9a-zA-Z-_' áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]+$/i",
        match: true,
        message: 'Veuillez entrez un prénom valide',
    )]
    #[ORM\Column(length: 255)]
    private ?string $firstName = null;
    

    #[Assert\NotBlank(message:"Le Nom est obligatoire")]
    #[Assert\Length(
        max: 255,
        maxMessage: 'Le Nom ne doit dépasser {{ limit }} caractéres.',
    )]
    #[Assert\Regex(
        pattern: "/^[0-9a-zA-Z-_' áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]+$/i",
        match: true,
        message: 'Veuillez entrez un Nom valide',
    )]
    #[ORM\Column(length: 255)]
    private ?string $lastName = null;
    


    #[Assert\NotBlank(message:"L'email est obligatoire")]
    #[Assert\Length(
        max: 255,
        maxMessage: 'L\'email ne doit dépasser {{ limit }} caractéres.',
    )]
    #[Assert\Email(
        message: 'L\'email {{ value }} n\'est pas valide ',
    )]
    #[ORM\Column(length: 100,unique:true)]
    private ?string $email = null;
    

    #[Assert\NotBlank(message:"Le numero de telephone  est obligatoire")]
    #[Assert\Length(
        max: 255,
        maxMessage: 'Le numéro de téléphone ne doit pas dépasser  {{ limit }} caractéres.',
    )]
    #[Assert\Regex(
        pattern: "/^[0-9\-\+\s\(\)]{6,30}$/", 
        match: true,
        message: 'Le numéro de téléphone n\'est pas valide ',
    )]
    #[ORM\Column(length: 255)]
    private ?string $phone = null;
    
    #[Assert\Length(
        max: 1000,
        maxMessage: 'Le commentaire ne doit pas dépasser  {{ limit }} caractéres.',
    )]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $comment = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
