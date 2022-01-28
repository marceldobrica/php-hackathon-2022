<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TrainingProgramRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrainingProgramRepository::class)]
#[ApiResource]
class TrainingProgram
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $name;

    #[ORM\Column(type: 'datetime_immutable')]
    private $startDateTime;

    #[ORM\Column(type: 'datetime_immutable')]
    private $endDateTime;

    #[ORM\Column(type: 'integer')]
    private $numarMaximParticipanti;

    #[ORM\ManyToOne(targetEntity: ProgramType::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $programType;

    #[ORM\ManyToOne(targetEntity: Room::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $room;


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

    public function getStartDateTime(): ?\DateTimeImmutable
    {
        return $this->startDateTime;
    }

    public function setStartDateTime(\DateTimeImmutable $startDateTime): self
    {
        $this->startDateTime = $startDateTime;

        return $this;
    }

    public function getEndDateTime(): ?\DateTimeImmutable
    {
        return $this->endDateTime;
    }

    public function setEndDateTime(\DateTimeImmutable $endDateTime): self
    {
        $this->endDateTime = $endDateTime;

        return $this;
    }

    public function getNumarMaximParticipanti(): ?int
    {
        return $this->numarMaximParticipanti;
    }

    public function setNumarMaximParticipanti(int $numarMaximParticipanti): self
    {
        $this->numarMaximParticipanti = $numarMaximParticipanti;

        return $this;
    }

    public function getProgramType(): ?ProgramType
    {
        return $this->programType;
    }

    public function setProgramType(?ProgramType $programType): self
    {
        $this->programType = $programType;

        return $this;
    }

    public function getRoom(): ?Room
    {
        return $this->room;
    }

    public function setRoom(?Room $room): self
    {
        $this->room = $room;

        return $this;
    }

}
