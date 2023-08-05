<?php

namespace Core\Modules\Post\Application\UseCases;

use Core\Modules\Post\Domain\Entities\Post;
use Core\Modules\Post\Domain\Repositories\PostRepository;
use Exception;

class GetPostById
{
    public function __construct(private readonly PostRepository $postRepository)
    {
    }

    /**
     * @throws Exception
     */
    public function execute(int $id): Post
    {
        $post = $this->postRepository->findById($id);

        if (empty($post))
            throw new Exception('Post not found');

        return $post;
    }
}
