<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository")
 */
class Contact
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull(),
     * @Assert\NotBlank(message = "Votre prénom '{{ value }}' ne doit pas être vide.")
     * @Assert\Length(
     *      min = 3,
     *      max = 255,
     *      minMessage = "Votre prénom doit contenir au moins 3 caractères.",
     *      maxMessage = "Votre prénom doit contenir moins de 255 caractères."
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull()
     * @Assert\NotBlank(message = "Votre nom ne doit pas être vide.")
     * @Assert\Length(
     *      min = 3,
     *      max = 255,
     *      minMessage = "Votre nom doit contenir au moins 3 caractères.",
     *      maxMessage = "Votre nom doit contenir moins de 255 caractères."
     * )
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull()
     * @Assert\Email(
     *     message = "Votre email '{{ value }}' n'est pas un email valide.",
     *     checkMX = false
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull()
     * @Assert\Length(
     *      min = 10,
     *      max = 10,
     *      exactMessage = "Votre numéro de téléphone doit contenir exactement 10 chiffres avec le format 0XXXXXXXXX ."
     * )
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull()
     * @Assert\Length(
     *      min = 3,
     *      max = 255,
     *      minMessage = "Votre qualité doit contenir au moins 3 caractères.",
     *      maxMessage = "Votre qualité doit contenir moins de 255 caractères."
     * )
     */
    private $quality;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotNull()
     * @Assert\NotBlank(message = "Votre description ne doit pas être vide.")
     * @Assert\Length(
     *      min = 10,
     *      minMessage = "Votre description doit contenir au moins 10 caractères."
     * )
     * 
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
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
     * @ORM\OneToOne(targetEntity="App\Entity\User", mappedBy="contact")
     */
    private $user;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Events", mappedBy="contacts")
     */
    private $events;

    public function __construct()
    {
        $this->events = new ArrayCollection();
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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getQuality(): ?string
    {   
        return $this->quality;
    }

    public function setQuality(string $quality): self
    {
        $this->quality = $quality;

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

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|Events[]
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Events $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->addContact($this);
        }

        return $this;
    }

    public function removeEvent(Events $event): self
    {
        if ($this->events->contains($event)) {
            $this->events->removeElement($event);
            $event->removeContact($this);
        }

        return $this;
    }

    public function getdisplayName()
    {
        $quality="";
        switch ($this->getQuality()) {
            case "leader_economique":
                $quality='Leader économique';
                break;
            case 'centre_formation':
                $quality='Centre de formation';
                break;
            case 'pouvoirs_publics':
                $quality='Pouvoirs publics';
                break;
            case 'association':
                $quality='Association';
                break;
            case 'partenaire_economique':
                $quality='Partenaire économique';
                break;
        }
        return $this->name.' '.$this->surname. ' - '.$this->email.'('.$quality.')';
    }

}
