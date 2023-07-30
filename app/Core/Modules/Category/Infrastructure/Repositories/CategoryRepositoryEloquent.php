<?php

namespace App\Core\Modules\Category\Infrastructure\Repositories;

use App\Core\Modules\Category\Domain\Entities\Category;
use App\Core\Modules\Category\Domain\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CategoryRepositoryEloquent extends Model implements CategoryRepository
{
    protected $table = 'categories';
    protected $fillable = ['title'];

    /** @var Category[] */
    private array $entityQueue = [];

    public function findById(int $id): ?Category
    {
        $eloquentModel = static::query()->find($id);

        if (empty($eloquentModel))
            return null;

        return Category::hydrate(
            $eloquentModel->id,
            $eloquentModel->title
        );
    }

    public function add(Category $category): void
    {
        $this->entityQueue[] = $category;
    }

    public function flush(): void
    {
        DB::transaction(function () {
            foreach ($this->entityQueue as $entity) {
                $properties = $entity->toArray();

                if (!empty($properties['id'])) {
                    static::query()->find($properties['id'])->update($properties);
                    continue;
                }

                $eloquentModel = static::query()->create($properties);
                Category::hydrateId($eloquentModel->id, $entity);
            }

            $this->entityQueue = [];
        });
    }

    public function saveAndFlush(Category $category): void
    {
        $this->add($category);
        $this->flush();
    }
}
