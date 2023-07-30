<?php

namespace App\Core\Modules\Category\Application\UseCases;

use App\Core\Modules\Category\Domain\Entities\Category;
use App\Core\Modules\Category\Domain\Repositories\CategoryRepository;

class CreateCategory
{
    public function __construct(private readonly CategoryRepository $categoryRepository)
    {
    }

    public function execute(string $title): Category
    {
        $category = new Category();
        $category->setTitle($title);

        $this->categoryRepository->saveAndFlush($category);

        return $category;
    }
}
