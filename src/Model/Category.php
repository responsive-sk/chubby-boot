<?php

declare(strict_types=1);

namespace App\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\Uuid;

final class Category implements ModelInterface
{
    private string $id;

    private \DateTimeImmutable $createdAt;

    private ?\DateTimeImmutable $updatedAt;

    private string $name;

    private ?string $image;

    /** @var Collection<int, Article> */
    private Collection $articles;

    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = null;
        $this->articles = new ArrayCollection();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): void
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->setCategory($this);
        }
    }

    public function removeArticle(Article $article): void
    {
        if ($this->articles->contains($article)) {
            $this->articles->removeElement($article);
            $article->setCategory(null);
        }
    }

    /**
     * @return array{
     *  id: string,
     *  createdAt: \DateTimeImmutable,
     *  updatedAt: null|\DateTimeImmutable,
     *  name: string,
     *  image: null|string
     * }
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
            'name' => $this->name,
            'image' => $this->image,
        ];
    }
}
