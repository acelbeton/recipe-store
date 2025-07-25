<?php

namespace App\Services;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class RecipeService
{
    public function getAllRecipes(array $filters = []): Collection
    {
        $query = Recipe::query();

        if (!empty($filters['search'])) {
            $query->where(function ($query) use ($filters) {
                $query->where('title', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('desc', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('instructions', 'like', '%' . $filters['search'] . '%');
            });
        }

        if (!$filters['tags']) {
            $query->whereJsonContains('tags', $filters['tags']);
        }


        return $query->get();
    }
    
    public function getRecipeById(int $id): ?Recipe
    {
        return Recipe::find($id);
    }

    public function searchRecipes(string $searchString): Collection
    {
        return Recipe::where('title', 'like', '%' . $searchString . '%')
                    ->orWhere('desc', 'like', '%' . $searchString . '%')
                    ->orWhere('instructions', 'like', '%' . $searchString . '%')
                    ->orWhere('ingredients', 'like', '%' . $searchString . '%')
                    ->whereJsonContains('tags', $searchString)
                    ->get();
    }

    public function getRecipesByTag(string $tag): Collection
    {
        return Recipe::whereJsonContains('tags', $tag)->get();
    }

    public function createRecipe(array $data): Recipe
    {
        if (isset($data['image'])) {
            $data['image_url'] = $this->handleImageUpload($data['image']);
            unset($data['image']);
        }

        $data['ingredients'] = json_encode($data['ingredients']);
        $data['tags'] = json_encode($data['tags'] ?? []);

        return Recipe::create($data);
    }

    public function updateRecipe(Recipe $recipe, array $data): Recipe
    {
        if (isset($data['image'])) {
            if ($recipe->image_url) {
                Storage::delete($recipe->image_url);
            }

            $data['image_url'] = $this->handleImageUpload($data['image']);
            unset($data['image']);
        }

        if (isset($data['ingredients'])) {
            $data['ingredients'] = json_encode($data['ingredients']);
        }

        if (isset($data['tags'])) {
            $data['tags'] = json_encode($data['tags'] ?? []);
        }

        $recipe->update($data);
        return $recipe->fresh();
    }

    public function deleteRecipe(Recipe $recipe): bool
    {
        if ($recipe->image_url) {
            Storage::delete($recipe->image_url);
        }

        return $recipe->delete();
    }

    private function handleImageUpload($image): string
    {
        return $image->store('recipes', 'public');
    }

    // TBD
    private function extractTikTokData(string $url): ?array
    {
        return null;
    }
}