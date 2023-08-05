<?php

namespace Core\Modules\Post\Application\UseCases;

use Core\Modules\Post\Domain\Entities\Post;
use Core\Modules\Post\Domain\Repositories\PostRepository;
use Illuminate\Support\Collection;

class GetAllPosts
{
    public function __construct(private readonly PostRepository $postRepository)
    {
    }

    /**
     * @return Collection<int,Post>
     */
    public function execute(): Collection
    {
        return $this->postRepository->findAll();
    }
}
