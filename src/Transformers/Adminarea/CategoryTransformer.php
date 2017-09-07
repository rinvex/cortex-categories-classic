<?php

declare(strict_types=1);

namespace Cortex\Categorizable\Transformers\Adminarea;

use League\Fractal\TransformerAbstract;
use Rinvex\Categorizable\Contracts\CategoryContract;

class CategoryTransformer extends TransformerAbstract
{
    /**
     * @return array
     */
    public function transform(CategoryContract $category)
    {
        return [
            'id' => (int) $category->id,
            'name' => (string) $category->name,
            'slug' => (string) $category->slug,
            'created_at' => (string) $category->created_at,
            'updated_at' => (string) $category->updated_at,
        ];
    }
}
