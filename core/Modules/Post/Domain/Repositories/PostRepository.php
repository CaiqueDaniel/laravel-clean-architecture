<?php

namespace Core\Modules\Post\Domain\Repositories;

use Core\Modules\Post\Domain\Entities\Post;

interface PostRepository
{
    public function findById(int $id): ?Post;

    public function add(Post $post): void;

    public function flush(): void;

    public function saveAndFlush(Post $post): void;
}
