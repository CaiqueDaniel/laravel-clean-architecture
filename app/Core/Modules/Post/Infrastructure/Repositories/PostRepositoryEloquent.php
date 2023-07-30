<?php

namespace App\Core\Modules\Post\Infrastructure\Repositories;

use App\Core\Modules\Category\Infrastructure\Repositories\CategoryRepositoryEloquent;
use App\Core\Modules\Post\Domain\Repositories\PostRepository;
use App\Core\Modules\Post\Domain\Entities\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PostRepositoryEloquent extends Model implements PostRepository
{
    protected $table = 'posts';
    protected $fillable = ['title', 'subtitle', 'article', 'category_id'];

    /** @var Post[] */
    private array $entityQueue = [];
    private CategoryRepositoryEloquent $categoryRepository;

    public function __construct()
    {
        parent::__construct([]);

        $this->categoryRepository = new CategoryRepositoryEloquent();
    }

    public function findById(int $id): ?Post
    {
        $eloquentModel = static::query()->find($id);

        if (empty($eloquentModel))
            return null;

        return Post::hydrate(
            $eloquentModel->id,
            $eloquentModel->title,
            $eloquentModel->subtitle,
            $eloquentModel->article,
            $eloquentModel->published_at,
            $eloquentModel->category_id ? $this->categoryRepository->findById($eloquentModel->category_id) : null
        );
    }

    public function add(Post $post): void
    {
        $this->entityQueue[] = $post;
    }

    public function flush(): void
    {
        DB::transaction(function () {
            foreach ($this->entityQueue as $entity) {
                $properties = [...$entity->toArray(), 'category_id' => $entity->getCategory()?->getId()];

                if (empty($properties['id'])) {
                    static::query()->create($properties);
                    continue;
                }

                static::query()->find($properties['id'])->fill($properties)->save();
            }

            $this->entityQueue = [];
        });
    }

    public function saveAndFlush(Post $post): void
    {
        $this->add($post);
        $this->flush();
    }
}
