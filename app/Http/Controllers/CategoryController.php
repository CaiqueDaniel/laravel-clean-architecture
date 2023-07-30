<?php

namespace App\Http\Controllers;

use App\Core\Modules\Category\Application\UseCases\CreateCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request, CreateCategory $useCase): JsonResponse
    {
        $category = $useCase->execute($request->get('title'));

        return response()->json($category);
    }
}
