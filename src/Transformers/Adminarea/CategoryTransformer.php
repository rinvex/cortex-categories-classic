<?php

declare(strict_types=1);

namespace Cortex\Categories\Transformers\Adminarea;

use League\Fractal\TransformerAbstract;
use Rinvex\Categories\Models\Category;

class CategoryTransformer extends TransformerAbstract
{
    /**
     * @return array
     */
    public function transform(Category $category): array
    {
        return [
            'id' => (int) $category->getKey(),
            'name' => (string) $category->name,
            'slug' => (string) $category->slug,
            'created_at' => (string) $category->created_at,
            'updated_at' => (string) $category->updated_at,
        ];
    }
}
