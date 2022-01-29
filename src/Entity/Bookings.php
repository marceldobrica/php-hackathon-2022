<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Action\NotFoundAction;
use App\Repository\BookingsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookingsRepository::class)]
#[ApiResource(
//    collectionOperations: [
//        'get' => [
//            'controller' => NotFoundAction::class,
//            'read' => false,
//            'output' => false,
//        ],
////        'get_by_cnp' => [
////            'controller' => NotFoundAction::class,
////            'read' => false,
////            'output' => false,
////        ],
//        'post'],
//    itemOperations: [
//        'get' => [
//            'controller' => NotFoundAction::class,
//            'read' => false,
//            'output' => false,
//        ],
//        'delete' => [
//            'path' => '/{cnp}/{id}',
//            'controller' => NotFoundAction::class,
//        ]
//    ]
)]
class Bookings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 13)]
    #[Asert\Regex('')]
    private $cnp;

    #[ORM\ManyToOne(targetEntity: TrainingProgram::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $program;

    #[ORM\Column(type: 'datetime_immutable')]
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCnp(): ?string
    {
        return $this->cnp;
    }

    public function setCnp(string $cnp): self
    {
        $this->cnp = $cnp;

        return $this;
    }

    public function getProgram(): ?TrainingProgram
    {
        return $this->program;
    }

    public function setProgram(?TrainingProgram $program): self
    {
        $this->program = $program;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

}
