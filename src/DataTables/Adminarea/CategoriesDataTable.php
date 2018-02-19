<?php

declare(strict_types=1);

namespace Cortex\Categories\DataTables\Adminarea;

use Rinvex\Categories\Models\Category;
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
            ->orderColumn('title', 'title->"$.'.app()->getLocale().'" $1')
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
            ? '"<a href=\""+routes.route(\'adminarea.categories.edit\', {category: full.name, locale: \''.$this->request->segment(1).'\'})+"\">"+data+"</a>"'
            : '"<a href=\""+routes.route(\'adminarea.categories.edit\', {category: full.name})+"\">"+data+"</a>"';

        return [
            'title' => ['title' => trans('cortex/categories::common.title'), 'render' => $link, 'responsivePriority' => 0],
            'name' => ['title' => trans('cortex/categories::common.name')],
            'created_at' => ['title' => trans('cortex/categories::common.created_at'), 'render' => "moment(data).format('MMM Do, YYYY')"],
            'updated_at' => ['title' => trans('cortex/categories::common.updated_at'), 'render' => "moment(data).format('MMM Do, YYYY')"],
        ];
    }
}
