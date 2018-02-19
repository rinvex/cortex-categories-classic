<?php

declare(strict_types=1);

namespace Cortex\Categories\Http\Controllers\Adminarea;

use Rinvex\Categories\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Cortex\Foundation\DataTables\LogsDataTable;
use Cortex\Foundation\Http\Controllers\AuthorizedController;
use Cortex\Categories\DataTables\Adminarea\CategoriesDataTable;
use Cortex\Categories\Http\Requests\Adminarea\CategoryFormRequest;

class CategoriesController extends AuthorizedController
{
    /**
     * {@inheritdoc}
     */
    protected $resource = 'category';

    /**
     * List all categories.
     *
     * @param \Cortex\Categories\DataTables\Adminarea\CategoriesDataTable $categoriesDataTable
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(CategoriesDataTable $categoriesDataTable)
    {
        return $categoriesDataTable->with([
            'id' => 'adminarea-categories-index-table',
            'phrase' => trans('cortex/categories::common.categories'),
        ])->render('cortex/foundation::adminarea.pages.datatable');
    }

    /**
     * List category logs.
     *
     * @param \Cortex\Categories\Models\Category          $category
     * @param \Cortex\Foundation\DataTables\LogsDataTable $logsDataTable
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function logs(Category $category, LogsDataTable $logsDataTable)
    {
        return $logsDataTable->with([
            'resource' => $category,
            'tabs' => 'adminarea.categories.tabs',
            'phrase' => trans('cortex/categories::common.categories'),
            'id' => "adminarea-categories-{$category->getKey()}-logs-table",
        ])->render('cortex/foundation::adminarea.pages.datatable-logs');
    }

    /**
     * Create new category.
     *
     * @param \Cortex\Categories\Models\Category $category
     *
     * @return \Illuminate\View\View
     */
    public function create(Category $category)
    {
        return $this->form($category);
    }

    /**
     * Edit given category.
     *
     * @param \Cortex\Categories\Models\Category $category
     *
     * @return \Illuminate\View\View
     */
    public function edit(Category $category)
    {
        return $this->form($category);
    }

    /**
     * Show category create/edit form.
     *
     * @param \Cortex\Categories\Models\Category $category
     *
     * @return \Illuminate\View\View
     */
    protected function form(Category $category)
    {
        return view('cortex/categories::adminarea.pages.category', compact('category'));
    }

    /**
     * Store new category.
     *
     * @param \Cortex\Categories\Http\Requests\Adminarea\CategoryFormRequest $request
     * @param \Cortex\Categories\Models\Category                             $category
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function store(CategoryFormRequest $request, Category $category)
    {
        return $this->process($request, $category);
    }

    /**
     * Update given category.
     *
     * @param \Cortex\Categories\Http\Requests\Adminarea\CategoryFormRequest $request
     * @param \Cortex\Categories\Models\Category                             $category
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function update(CategoryFormRequest $request, Category $category)
    {
        return $this->process($request, $category);
    }

    /**
     * Process stored/updated category.
     *
     * @param \Illuminate\Foundation\Http\FormRequest $request
     * @param \Cortex\Categories\Models\Category      $category
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    protected function process(FormRequest $request, Category $category)
    {
        // Prepare required input fields
        $data = $request->validated();

        // Save category
        $category->fill($data)->save();

        return intend([
            'url' => route('adminarea.categories.index'),
            'with' => ['success' => trans('cortex/foundation::messages.resource_saved', ['resource' => 'category', 'id' => $category->name])],
        ]);
    }

    /**
     * Destroy given category.
     *
     * @param \Cortex\Categories\Models\Category $category
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return intend([
            'url' => route('adminarea.categories.index'),
            'with' => ['warning' => trans('cortex/foundation::messages.resource_deleted', ['resource' => 'category', 'id' => $category->name])],
        ]);
    }
}
