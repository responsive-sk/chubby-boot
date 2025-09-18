<?php

declare(strict_types=1);

namespace App\Dto\Model;

use App\Model\ModelInterface;
use App\Model\Category;

final class CategoryRequest implements ModelRequestInterface
{
    public string $name;

    public ?string $image;

    public function createModel(): ModelInterface
    {
        $model = new Category();
        $model->setName($this->name);
        $model->setImage($this->image);

        return $model;
    }

    /**
     * @param Category $model
     */
    public function updateModel(ModelInterface $model): ModelInterface
    {
        $model->setUpdatedAt(new \DateTimeImmutable());
        $model->setName($this->name);
        $model->setImage($this->image);

        return $model;
    }
}
