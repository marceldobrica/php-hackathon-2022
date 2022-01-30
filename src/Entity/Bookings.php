<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Action\NotFoundAction;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\BookingsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator as AppAssert;

#[ORM\Entity(repositoryClass: BookingsRepository::class)]
#[ApiResource(
//    normalizationContext: ["groups" => ["bookings:read"]],
//    denormalizationContext: ["groups" => ["bookings:write"]],
//    attributes: ['pagination_items_per_page' => 3]

)]
#[ApiFilter(SearchFilter::class, properties: ['cnp' => 'exact'])]
class Bookings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 13)]
    #[Groups(["bookings:read", "bookings:write"])]
    #[Assert\Regex('/^[1-9]\d{2}(0[1-9]|1[0-2])(0[1-9]|[12]\d|3[01])(0[1-9]|[1-4]\d|5[0-2]|99)(00[1-9]|0[1-9]\d|[1-9]\d\d)\d$/')]
    //...copied from internet...todo verify...
    #[AppAssert\ConstrainsBookingProgram]
    private $cnp;

    #[ORM\ManyToOne(targetEntity: Program::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["bookings:read", "bookings:write"])]
    #[Assert\NotBlank]
    #[AppAssert\ConstrainsBookingProgram]
    private $program;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
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

    public function getProgram(): ?Program
    {
        return $this->program;
    }

    public function setProgram(?Program $program): self
    {
        $this->program = $program;

        return $this;
    }

    public function getCreatedAt(): ?string //?\DateTimeInterface
    {
        return $this->createdAt->format('yy-m-d h:m');
    }

}
