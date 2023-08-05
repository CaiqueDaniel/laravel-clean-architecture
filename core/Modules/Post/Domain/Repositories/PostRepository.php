<?php

namespace Core\Modules\Post\Domain\Repositories;

use Core\Modules\Post\Domain\Entities\Post;
use Illuminate\Support\Collection;

interface PostRepository
{
    public function findById(int $id): ?Post;

    public function add(Post $post): void;

    public function flush(): void;

    public function saveAndFlush(Post $post): void;

    public function findAll(): Collection;
}
