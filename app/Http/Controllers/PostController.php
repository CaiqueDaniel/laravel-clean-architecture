<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Core\Modules\Category\Application\UseCases\GetCategoryById;
use Core\Modules\Post\Application\UseCases\CreatePost;
use Core\Modules\Post\Application\UseCases\GetAllPosts;
use Core\Modules\Post\Application\UseCases\GetPostById;
use Core\Modules\Post\Application\UseCases\PublishPost;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    public function index(GetAllPosts $useCase): JsonResponse
    {
        return response()->json($useCase->execute());
    }

    public function store(PostRequest $request, CreatePost $createPost, GetCategoryById $getCategoryById): JsonResponse
    {
        $postDto = $request->toDTO();

        $category = $postDto->getCategory() ? $getCategoryById->execute($postDto->getCategory()) : null;
        $post = $createPost->execute($postDto, $category);

        return response()->json($post);
    }

    public function publish(string $id, GetPostById $getPostById, PublishPost $publishPost): JsonResponse
    {
        $post = $getPostById->execute($id);
        return response()->json($publishPost->execute($post));
    }
}
