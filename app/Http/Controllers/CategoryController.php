<?php

namespace App\Http\Controllers;

use App\Core\Modules\Category\Application\UseCases\{CreateCategory, GetAllCategories};
use Illuminate\Http\{JsonResponse, Request};

class CategoryController extends Controller
{
    public function index(GetAllCategories $useCase): JsonResponse
    {
        return response()->json($useCase->execute());
    }

    public function store(Request $request, CreateCategory $useCase): JsonResponse
    {
        $category = $useCase->execute($request->get('title'));

        return response()->json($category);
    }
}
