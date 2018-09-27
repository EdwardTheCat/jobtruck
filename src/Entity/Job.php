<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JobRepository")
 */
class Job
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull()
     * @Assert\NotBlank(message = "Votre titre ne doit pas être vide.")
     * @Assert\Length(
     *      min = 3,
     *      max = 255,
     *      minMessage = "Votre titre doit contenir au moins 3 caractères.",
     *      maxMessage = "Votre titre doit contenir moins de 255 caractères."
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotNull()
     * @Assert\NotBlank(message = "Votre description ne doit pas être vide.")
     * @Assert\Length(
     *      min = 3,
     *      minMessage = "Votre description doit contenir au moins 3 caractères.",
     *)
     * 
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull()
     * @Assert\Email(
     *     message = "Votre email '{{ value }}' n'est pas un email valide.",
     *     checkMX = false
     * )
     */
    private $contact;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull()
     * @Assert\File(
     *      maxSize="5242880",
     *      mimeTypes = {
     *          "image/png",
     *          "image/jpeg",
     *          "image/jpg",
     *          "image/gif",
     *      }
     * )
     */
    private $logo;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAT;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotNull()
     */
    private $validity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(string $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getCreatedAT(): ?\DateTimeInterface
    {
        return $this->createdAT;
    }

    public function setCreatedAT(\DateTimeInterface $createdAT): self
    {
        $this->createdAT = $createdAT;

        return $this;
    }

    public function getValidity(): ?int
    {
        return $this->validity;
    }

    public function setValidity(int $validity): self
    {
        $this->validity = $validity;

        return $this;
    }
}
