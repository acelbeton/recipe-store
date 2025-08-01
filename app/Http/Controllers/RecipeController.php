<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipeRequest;
use App\Http\Resources\RecipeResource;
use App\Models\Recipe;
use App\Services\RecipeService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;

class RecipeController extends Controller
{
    protected RecipeService $recipeService;

    public function __construct(RecipeService $recipeService)
    {
        $this->recipeService = $recipeService;
    }

    public function create(): Response
    {
        return Inertia::render('recipe/CreateRecipe');
    }

    public function store(RecipeRequest $request): JsonResponse
    {
        try {
            $result = $this->recipeService->createRecipe($request->validated());
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Creation successful',
                    'data' => new RecipeResource($result)
                ], 201);
        } catch (Exception $exception) {
            Log::error('Recipe creation failed', [
                'error' => $exception->getMessage(),
                'code' => $exception->getCode()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Creation failed',
            ], 500);
        }
    }

    public function update(RecipeRequest $request, Recipe $recipe): JsonResponse
    {
        try {
            $recipe = $this->recipeService->updateRecipe($recipe, $request->validated());
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Creation successful',
                    'data' => new RecipeResource($recipe)
                ], 201);
        } catch (Exception $exception) {
            Log::error('Recipe update failed', [
                'recipe_id' => $recipe->getKey(),
                'error' => $exception->getMessage(),
                'code' => $exception->getCode()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Creation failed',
            ], 500);
        }
    }

    public function delete(Recipe $recipe): JsonResponse
    {
        try {
            $this->recipeService->deleteRecipe($recipe);
            return response()->json([
                'success' => true,
                'message' => 'Deletion successful',
            ], 200);

        } catch (Exception $exception) {
            Log::error('Recipe delete failed', [
                'recipe_id' => $recipe->getKey(),
                'error' => $exception->getMessage(),
                'code' => $exception->getCode()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Deletion failed',
            ], 500);
        }
    }
}
