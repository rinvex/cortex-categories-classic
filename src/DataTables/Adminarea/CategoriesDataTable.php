<?php

declare(strict_types=1);

namespace Cortex\Categories\DataTables\Adminarea;

use Illuminate\Http\JsonResponse;
use Cortex\Categories\Models\Category;
use Cortex\Foundation\DataTables\AbstractDataTable;
use Cortex\Categories\Transformers\Adminarea\CategoryTransformer;

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
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax(): JsonResponse
    {
        return datatables($this->query())
            ->setTransformer(app($this->transformer))
            ->orderColumn('name', 'name->"$.'.app()->getLocale().'" $1')
            ->make(true);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        $link = config('cortex.foundation.route.locale_prefix')
            ? '"<a href=\""+routes.route(\'adminarea.cortex.categories.categories.edit\', {category: full.id, locale: \''.$this->request()->segment(1).'\'})+"\">"+data+"</a>"'
            : '"<a href=\""+routes.route(\'adminarea.cortex.categories.categories.edit\', {category: full.id})+"\">"+data+"</a>"';

        return [
            'id' => ['checkboxes' => '{"selectRow": true}', 'exportable' => false, 'printable' => false],
            'name' => ['title' => trans('cortex/categories::common.name'), 'render' => $link, 'responsivePriority' => 0],
            'created_at' => ['title' => trans('cortex/categories::common.created_at'), 'render' => "moment(data).format('YYYY-MM-DD, hh:mm:ss A')"],
            'updated_at' => ['title' => trans('cortex/categories::common.updated_at'), 'render' => "moment(data).format('YYYY-MM-DD, hh:mm:ss A')"],
        ];
    }
}
