<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PostRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PostRepository::class)]
#[ApiResource(
    collectionOperations: ['get' => ['normalization_context' => ['groups' => 'Post:list']], 'post' => ['normalization_context' => ['groups' => 'Post:list']]],
    itemOperations: ['get' => ['normalization_context' => ['groups' => 'Post:item']], 'put' => ['normalization_context' => ['groups' => 'Post:item']], 'patch' => ['normalization_context' => ['groups' => 'Post:item']], 'delete' => ['normalization_context' => ['groups' => 'Post:item']]],
    order: ['message' => 'DESC', 'id' => 'ASC'],
    paginationEnabled: false,
)]
class Post

{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['Post:list', 'Post:item'])]
    private ?int $id = null;

    #[ORM\Column(length: 2000)]
    #[Groups(['Post:list', 'Post:item'])]
    private ?string $message = null;

    #[ORM\ManyToOne(inversedBy: 'posts')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['Post:list', 'Post:item'])]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

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
}
