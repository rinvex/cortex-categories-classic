<?php

declare(strict_types=1);

namespace Cortex\Categories\DataTables\Adminarea;

use Cortex\Categories\Models\Category;
use Cortex\Foundation\DataTables\AbstractDataTable;

class CategoriesDataTable extends AbstractDataTable
{
    /**
     * {@inheritdoc}
     */
    protected $model = Category::class;

    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return datatables($this->query())
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
            ? '"<a href=\""+routes.route(\'adminarea.categories.edit\', {category: hashids.encode(full.id), locale: \''.$this->request->segment(1).'\'})+"\">"+data+"</a>"'
            : '"<a href=\""+routes.route(\'adminarea.categories.edit\', {category: hashids.encode(full.id)})+"\">"+data+"</a>"';

        return [
            'name' => ['title' => trans('cortex/categories::common.name'), 'render' => $link, 'responsivePriority' => 0],
            'created_at' => ['title' => trans('cortex/categories::common.created_at'), 'render' => "moment(data).format('MMM Do, YYYY')"],
            'updated_at' => ['title' => trans('cortex/categories::common.updated_at'), 'render' => "moment(data).format('MMM Do, YYYY')"],
        ];
    }
}
