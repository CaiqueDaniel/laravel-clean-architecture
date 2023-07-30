<?php

namespace App\Core\Modules\Category\Application\UseCases;

use App\Core\Modules\Category\Domain\Repositories\CategoryRepository;
use Illuminate\Support\Collection;

class GetAllCategories
{
    public function __construct(private readonly CategoryRepository $categoryRepository)
    {
    }

    public function execute(): Collection
    {
        return $this->categoryRepository->findAll();
    }
}
