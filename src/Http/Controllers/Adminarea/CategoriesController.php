<?php

declare(strict_types=1);

namespace Cortex\Categories\Http\Controllers\Adminarea;

use Illuminate\Http\Request;
use Cortex\Foundation\DataTables\LogsDataTable;
use Rinvex\Categories\Contracts\CategoryContract;
use Cortex\Foundation\Http\Controllers\AuthorizedController;
use Cortex\Categories\DataTables\Adminarea\CategoriesDataTable;
use Cortex\Categories\Http\Requests\Adminarea\CategoryFormRequest;

class CategoriesController extends AuthorizedController
{
    /**
     * {@inheritdoc}
     */
    protected $resource = 'categories';

    /**
     * Display a listing of the resource.
     *
     * @param \Cortex\Categories\DataTables\Adminarea\CategoriesDataTable $categoriesDataTable
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(CategoriesDataTable $categoriesDataTable)
    {
        return $categoriesDataTable->with([
            'id' => 'cortex-categories',
            'phrase' => trans('cortex/categories::common.categories'),
        ])->render('cortex/foundation::adminarea.pages.datatable');
    }

    /**
     * Display a listing of the resource logs.
     *
     * @param \Rinvex\Categories\Contracts\CategoryContract $category
     * @param \Cortex\Foundation\DataTables\LogsDataTable   $logsDataTable
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function logs(CategoryContract $category, LogsDataTable $logsDataTable)
    {
        return $logsDataTable->with([
            'tab' => 'logs',
            'type' => 'categories',
            'resource' => $category,
            'id' => 'cortex-categories-logs',
            'phrase' => trans('cortex/categories::common.categories'),
        ])->render('cortex/foundation::adminarea.pages.datatable-tab');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Cortex\Categories\Http\Requests\Adminarea\CategoryFormRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryFormRequest $request)
    {
        return $this->process($request, app('rinvex.categories.category'));
    }

    /**
     * Update the given resource in storage.
     *
     * @param \Cortex\Categories\Http\Requests\Adminarea\CategoryFormRequest $request
     * @param \Rinvex\Categories\Contracts\CategoryContract                  $category
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryFormRequest $request, CategoryContract $category)
    {
        return $this->process($request, $category);
    }

    /**
     * Delete the given resource from storage.
     *
     * @param \Rinvex\Categories\Contracts\CategoryContract $category
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(CategoryContract $category)
    {
        $category->delete();

        return intend([
            'url' => route('adminarea.categories.index'),
            'with' => ['warning' => trans('cortex/categories::messages.category.deleted', ['slug' => $category->slug])],
        ]);
    }

    /**
     * Show the form for create/update of the given resource.
     *
     * @param \Rinvex\Categories\Contracts\CategoryContract $category
     *
     * @return \Illuminate\Http\Response
     */
    public function form(CategoryContract $category)
    {
        return view('cortex/categories::adminarea.forms.category', compact('category'));
    }

    /**
     * Process the form for store/update of the given resource.
     *
     * @param \Illuminate\Http\Request                      $request
     * @param \Rinvex\Categories\Contracts\CategoryContract $category
     *
     * @return \Illuminate\Http\Response
     */
    protected function process(Request $request, CategoryContract $category)
    {
        // Prepare required input fields
        $data = $request->all();

        // Save category
        $category->fill($data)->save();

        return intend([
            'url' => route('adminarea.categories.index'),
            'with' => ['success' => trans('cortex/categories::messages.category.saved', ['slug' => $category->slug])],
        ]);
    }
}
