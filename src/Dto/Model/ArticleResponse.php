<?php

declare(strict_types=1);

namespace App\Dto\Model;

final class ArticleResponse implements \JsonSerializable
{
    public string $id;

    public string $createdAt;

    public ?string $updatedAt;

    public string $title;

    public string $content;

    public ?string $tag;

    public ?string $image;

    public ?CategoryResponse $category;

    public string $_type;

    /**
     * @var array<string, array{
     *   href: string,
     *   templated:bool,
     *   rel: array<string>,
     *   attributes: array<string, string>
     * }>
     */
    public array $_links;

    /**
     * @return array{
     *   id:string,
     *   createdAt:string,
     *   updatedAt:null|string,
     *   title:string,
     *   content:string,
     *   tag:null|string,
     *   image:null|string,
     *   category:null|array<string, mixed>,
     *   _type:string,
     *   _links:array<string, array{
     *     href:string,
     *     templated:bool,
     *     rel:array<string>,
     *     attributes:array<string, string>
     *   }>
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
            '_type' => $this->_type,
            '_links' => $this->_links,
        ];
    }
}
