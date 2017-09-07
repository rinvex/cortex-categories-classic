<?php

declare(strict_types=1);

namespace Cortex\Categorizable\DataTables\Adminarea;

use Cortex\Foundation\DataTables\AbstractDataTable;
use Rinvex\Categorizable\Contracts\CategoryContract;
use Cortex\Categorizable\Transformers\Adminarea\CategoryTransformer;

class CategoriesDataTable extends AbstractDataTable
{
    /**
     * {@inheritdoc}
     */
    protected $model = CategoryContract::class;

    /**
     * {@inheritdoc}
     */
    protected $transformer = CategoryTransformer::class;

    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        $transformer = app($this->transformer);

        return datatables()->eloquent($this->query())
                           ->setTransformer($transformer)
                           ->orderColumn('name', 'name->"$.'.app()->getLocale().'" $1')
                           ->make(true);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'name' => ['title' => trans('cortex/categorizable::common.name'), 'render' => '"<a href=\""+routes.route(\'adminarea.categories.edit\', {category: full.slug})+"\">"+data+"</a>"', 'responsivePriority' => 0],
            'slug' => ['title' => trans('cortex/categorizable::common.slug')],
            'created_at' => ['title' => trans('cortex/categorizable::common.created_at'), 'render' => "moment(data).format('MMM Do, YYYY')"],
            'updated_at' => ['title' => trans('cortex/categorizable::common.updated_at'), 'render' => "moment(data).format('MMM Do, YYYY')"],
        ];
    }
}
