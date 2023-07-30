<?php

namespace App\Core\Modules\Category\Domain\Repositories;

use App\Core\Modules\Category\Domain\Entities\Category;
use Illuminate\Support\Collection;

interface CategoryRepository
{
    public function findAll(): Collection;

    public function findById(int $id): ?Category;

    public function add(Category $category): void;

    public function flush(): void;

    public function saveAndFlush(Category $category): void;
}
