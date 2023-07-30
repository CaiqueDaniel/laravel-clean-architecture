<?php

namespace Core\Modules\Category\Domain\Entities;

use Illuminate\Contracts\Support\Arrayable;

class Category implements Arrayable
{
    private int $id;
    private string $title;

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id ?? null,
            'title' => $this->title
        ];
    }

    private function setId(int $value): self
    {
        $this->id = $value;
        return $this;
    }

    public static function hydrate(int $id, string $title): static
    {
        $category = new Category();

        return $category
            ->setId($id)
            ->setTitle($title);
    }

    public static function hydrateId(int $id, Category $category): static
    {
        return $category->setId($id);
    }
}
