<?php

namespace JacobHyde\Tickets\App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use JacobHyde\Tickets\App\Http\Resources\CategoryResource;
use JacobHyde\Tickets\App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(Category::all())
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}