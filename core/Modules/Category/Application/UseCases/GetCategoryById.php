<?php

namespace Core\Modules\Category\Application\UseCases;

use Core\Modules\Category\Domain\Entities\Category;
use Core\Modules\Category\Domain\Repositories\CategoryRepository;
use Exception;

class GetCategoryById
{
    public function __construct(private readonly CategoryRepository $categoryRepository)
    {
    }

    /**
     * @throws Exception
     */
    public function execute(int $id): Category
    {
        $category = $this->categoryRepository->findById($id);

        if (empty($category))
            throw new Exception('Category not found');

        return $category;
    }
}
