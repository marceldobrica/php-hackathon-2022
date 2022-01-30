<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TrainingProgramRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TrainingProgramRepository::class)]
#[ApiResource(
//    normalizationContext:['groups' => ['bookings:read', 'program:read']],
//    denormalizationContext: ['groups' => ['bookings:write', 'program:write']]
)]
class Program
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['bookings:read', 'program:read'])]
    private $id;

    /**
     * A training program name to better identify it ex: Pillates class for beginners
     */
    #[ORM\Column(type: 'string', length: 100)]
    #[Groups(['bookings:read','program:read', 'program:write'])]
    private $name;

    #[ORM\Column(type: 'datetime')]
    #[Groups(['bookings:read', 'write', 'program'])]
    private $startDateTime;

    #[ORM\Column(type: 'datetime')]
    #[Groups(['bookings:read', 'write', 'program'])]
    private $endDateTime;

    #[ORM\Column(type: 'integer')]
    #[Groups(['read', 'write', 'program'])]
    private $numarMaximParticipanti;

    #[ORM\ManyToOne(targetEntity: ProgramType::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $programType;

    #[ORM\ManyToOne(targetEntity: Room::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $room;

    #[ORM\Column(type: 'integer')]
    private $participants;

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

    public function getStartDateTime(): ?string
    {
        return $this->startDateTime->format('Y-m-d H:i');
    }

    public function setStartDateTime(\DateTimeInterface $startDateTime): self
    {
        $this->startDateTime = $startDateTime;

        return $this;
    }

    public function getEndDateTime(): ?string
    {
        return $this->endDateTime->format('Y-m-d H:i');
    }

    public function setEndDateTime(\DateTimeInterface $endDateTime): self
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

    public function getParticipants(): ?int
    {
        return $this->participants;
    }

    public function setParticipants(int $participants): self
    {
        $this->participants = $participants;

        return $this;
    }

}
