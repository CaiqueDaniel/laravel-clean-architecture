<?php

namespace Core\Modules\Post\Domain\Entities;

use Core\Modules\Category\Domain\Entities\Category;
use DateTime;
use Illuminate\Contracts\Support\Arrayable;

class Post implements Arrayable
{
    private int $id;
    private string $title;
    private string $subtitle;
    private string $article;
    private ?DateTime $publishedAt;
    private ?Category $category;

    public function isPublished(): bool
    {
        return $this->getPublishedAt() != null;
    }

    public function publish(): self
    {
        $this->publishedAt = new DateTime('now');
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
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

    public function getPublishedAt(): ?DateTime
    {
        return $this->publishedAt;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setTitle(string $value): self
    {
        $this->title = $value;
        return $this;
    }

    public function setSubtitle(string $value): self
    {
        $this->subtitle = $value;
        return $this;
    }

    public function setArticle(string $value): self
    {
        $this->article = $value;
        return $this;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id ?? null,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'article' => $this->article,
            'published_at' => $this->publishedAt ?? null,
            'category' => $this->category?->toArray()
        ];
    }

    private function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    private function setPublishedAt(DateTime $value): self
    {
        $this->publishedAt = $value;
        return $this;
    }

    public static function hydrate(
        int       $id,
        string    $title,
        string    $subtitle,
        string    $article,
        ?DateTime $publishedAt,
        ?Category $category
    ): Post
    {
        $post = new Post();

        if (!empty($publishedAt))
            $post->setPublishedAt($publishedAt);

        return $post
            ->setId($id)
            ->setTitle($title)
            ->setSubtitle($subtitle)
            ->setArticle($article)
            ->setCategory($category);
    }
}
