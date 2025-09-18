<?php

declare(strict_types=1);

namespace App\Model;

use Ramsey\Uuid\Uuid;

final class Article implements ModelInterface
{
    private string $id;

    private \DateTimeImmutable $createdAt;

    private ?\DateTimeImmutable $updatedAt;

    private string $title;

    private string $content;

    private ?string $tag;

    private ?string $image;

    private ?Category $category;

    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = null;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getTag(): ?string
    {
        return $this->tag;
    }

    public function setTag(?string $tag): void
    {
        $this->tag = $tag;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): void
    {
        $this->category = $category;
    }

    /**
     * @return array{
     *  id: string,
     *  createdAt: \DateTimeImmutable,
     *  updatedAt: null|\DateTimeImmutable,
     *  title: string,
     *  content: string,
     *  tag: null|string,
     *  image: null|string,
     *  category: null|array{id: string, name: string}
     * }
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
            'title' => $this->title,
            'content' => $this->content,
            'tag' => $this->tag,
            'image' => $this->image,
            'category' => $this->category ? $this->category->jsonSerialize() : null,
        ];
    }
}
