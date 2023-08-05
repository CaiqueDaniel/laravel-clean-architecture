<?php

namespace Core\Modules\Post\Dtos;

class PostDTO
{
    public function __construct(
        private readonly string $title,
        private readonly string $subtitle,
        private readonly string $article,
        private readonly ?int   $category
    )
    {
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSubtitle(): string
    {
        return $this->subtitle;
    }

    public function getArticle(): string
    {
        return $this->article;
    }

    public function getCategory(): ?int
    {
        return $this->category;
    }
}
