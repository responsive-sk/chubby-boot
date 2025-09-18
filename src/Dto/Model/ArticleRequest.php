<?php

declare(strict_types=1);

namespace App\Dto\Model;

use App\Model\ModelInterface;
use App\Model\Article;
use App\Model\Category;

final class ArticleRequest implements ModelRequestInterface
{
    public string $title;

    public string $content;

    public ?string $tag;

    public ?string $image;

    public ?string $categoryId;

    public function createModel(): ModelInterface
    {
        $model = new Article();
        $model->setTitle($this->title);
        $model->setContent($this->content);
        $model->setTag($this->tag);
        $model->setImage($this->image);

        if ($this->categoryId !== null) {
            $category = new Category();
            $category->setId($this->categoryId);
            $model->setCategory($category);
        }

        return $model;
    }

    /**
     * @param ModelInterface $model
     */
    public function updateModel(ModelInterface $model): ModelInterface
    {
        if (!$model instanceof Article) {
            throw new \TypeError('Expected instance of Article');
        }

        $model->setUpdatedAt(new \DateTimeImmutable());
        $model->setTitle($this->title);
        $model->setContent($this->content);
        $model->setTag($this->tag);
        $model->setImage($this->image);

        if ($this->categoryId !== null) {
            $category = new Category();
            $category->setId($this->categoryId);
            $model->setCategory($category);
        } else {
            $model->setCategory(null);
        }

        return $model;
    }
}
