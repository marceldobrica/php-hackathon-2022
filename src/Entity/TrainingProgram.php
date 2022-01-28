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

    #[ORM\Column(type: 'string', length: 50)]
    private $trainingProgramType;

    #[ORM\Column(type: 'datetime_immutable')]
    private $startDateTime;

    #[ORM\Column(type: 'datetime_immutable')]
    private $endDateTime;

    #[ORM\Column(type: 'integer')]
    private $numarMaximParticipanti;

    #[ORM\Column(type: 'string', length: 20)]
    private $room;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTrainingProgramType(): ?string
    {
        return $this->trainingProgramType;
    }

    public function setTrainingProgramType(string $trainingProgramType): self
    {
        $this->trainingProgramType = $trainingProgramType;

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

    public function getRoom(): ?string
    {
        return $this->room;
    }

    public function setRoom(string $room): self
    {
        $this->room = $room;

        return $this;
    }
}
