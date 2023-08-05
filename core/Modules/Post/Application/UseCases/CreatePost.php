<?php

namespace Core\Modules\Post\Application\UseCases;

use Core\Modules\Category\Domain\Entities\Category;
use Core\Modules\Post\Domain\Entities\Post;
use Core\Modules\Post\Domain\Repositories\PostRepository;
use Core\Modules\Post\Dtos\PostDTO;

class CreatePost
{
    public function __construct(private PostRepository $postRepository)
    {
    }

    public function execute(PostDTO $dto, ?Category $category): Post
    {
        $post = new Post();

        $post
            ->setTitle($dto->getTitle())
            ->setSubtitle($dto->getSubtitle())
            ->setArticle($dto->getArticle())
            ->setCategory($category);

        $this->postRepository->saveAndFlush($post);

        return $post;
    }
}
