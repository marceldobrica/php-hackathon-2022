<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\RoomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomRepository::class)]
#[ApiResource()]
class Room
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'integer')]
    private $maxPersonsInRoom;

    #[ORM\ManyToMany(targetEntity: ProgramType::class)]
    private $programTypes;

    public function __construct()
    {
        $this->programTypes = new ArrayCollection();
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

    public function getMaxPersonsInRoom(): ?int
    {
        return $this->maxPersonsInRoom;
    }

    public function setMaxPersonsInRoom(int $maxPersonsInRoom): self
    {
        $this->maxPersonsInRoom = $maxPersonsInRoom;

        return $this;
    }

    /**
     * @return Collection|ProgramType[]
     */
    public function getProgramTypes(): Collection
    {
        return $this->programTypes;
    }

    public function addProgramType(ProgramType $programType): self
    {
        if (!$this->programTypes->contains($programType)) {
            $this->programTypes[] = $programType;
        }

        return $this;
    }

    public function removeProgramType(ProgramType $programType): self
    {
        $this->programTypes->removeElement($programType);

        return $this;
    }
}
