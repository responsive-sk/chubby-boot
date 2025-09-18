<?php

declare(strict_types=1);

namespace App\Dto\Model;

final class CategoryResponse implements \JsonSerializable
{
    public string $id;

    public string $createdAt;

    public ?string $updatedAt;

    public string $name;

    public ?string $image;

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
     *   name:string,
     *   image:null|string,
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
            'name' => $this->name,
            'image' => $this->image,
            '_type' => $this->_type,
            '_links' => $this->_links,
        ];
    }
}
