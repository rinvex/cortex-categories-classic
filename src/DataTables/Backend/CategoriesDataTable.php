<?php

declare(strict_types=1);

namespace Cortex\Categorizable\DataTables\Backend;

use Cortex\Categorizable\Models\Category;
use Cortex\Foundation\DataTables\AbstractDataTable;
use Cortex\Categorizable\Transformers\Backend\CategoryTransformer;

class CategoriesDataTable extends AbstractDataTable
{
    /**
     * {@inheritdoc}
     */
    protected $model = Category::class;

    /**
     * {@inheritdoc}
     */
    protected $transformer = CategoryTransformer::class;

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'name' => ['title' => trans('cortex/categorizable::common.name'), 'render' => '"<a href=\""+routes.route(\'backend.categories.edit\', {category: full.id})+"\">"+data+"</a>"', 'responsivePriority' => 0],
            'slug' => ['title' => trans('cortex/categorizable::common.slug')],
            'created_at' => ['title' => trans('cortex/categorizable::common.created_at'), 'render' => "moment(data).format('MMM Do, YYYY')"],
            'updated_at' => ['title' => trans('cortex/categorizable::common.updated_at'), 'render' => "moment(data).format('MMM Do, YYYY')"],
        ];
    }
}
