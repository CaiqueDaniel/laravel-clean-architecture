<?php

namespace Core\Modules\Post\Application\UseCases;

use Core\Modules\Post\Domain\Entities\Post;
use Core\Modules\Post\Domain\Repositories\PostRepository;

class PublishPost
{
    public function __construct(private readonly PostRepository $postRepository)
    {
    }

    public function execute(Post $post): Post
    {
        $this->postRepository->saveAndFlush($post->publish());

        return $post;
    }
}
