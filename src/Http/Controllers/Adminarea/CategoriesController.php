<?php

declare(strict_types=1);

namespace Cortex\Categories\Http\Controllers\Adminarea;

use Illuminate\Http\Request;
use Cortex\Categories\Models\Category;
use Cortex\Foundation\Http\FormRequest;
use Cortex\Foundation\DataTables\LogsDataTable;
use Cortex\Foundation\Importers\InsertImporter;
use Cortex\Foundation\Http\Requests\ImportFormRequest;
use Cortex\Foundation\Http\Controllers\AuthorizedController;
use Cortex\Categories\DataTables\Adminarea\CategoriesDataTable;
use Cortex\Categories\Http\Requests\Adminarea\CategoryFormRequest;

class CategoriesController extends AuthorizedController
{
    /**
     * {@inheritdoc}
     */
    protected $resource = 'rinvex.categories.models.category';

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
            'id' => 'adminarea-cortex-categories-categories-index',
            'routePrefix' => 'adminarea.cortex.categories.categories',
            'pusher' => ['entity' => 'category', 'channel' => 'cortex.categories.categories.index'],
        ])->render('cortex/foundation::adminarea.pages.datatable-index');
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
            'tabs' => 'adminarea.cortex.categories.categories.tabs',
            'id' => "adminarea-cortex-categories-categories-{$category->getRouteKey()}-logs",
        ])->render('cortex/foundation::adminarea.pages.datatable-tab');
    }

    /**
     * Import categories.
     *
     * @param \Cortex\Foundation\Http\Requests\ImportFormRequest $request
     * @param \Cortex\Foundation\Importers\InsertImporter        $importer
     * @param \Cortex\Categories\Models\Category                 $category
     *
     * @return void
     */
    public function import(ImportFormRequest $request, InsertImporter $importer, Category $category)
    {
        $importer->withModel($category)->import($request->file('file'));
    }

    /**
     * Create new category.
     *
     * @param \Illuminate\Http\Request           $request
     * @param \Cortex\Categories\Models\Category $category
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request, Category $category)
    {
        return $this->form($request, $category);
    }

    /**
     * Edit given category.
     *
     * @param \Illuminate\Http\Request           $request
     * @param \Cortex\Categories\Models\Category $category
     *
     * @return \Illuminate\View\View
     */
    public function edit(Request $request, Category $category)
    {
        return $this->form($request, $category);
    }

    /**
     * Show category create/edit form.
     *
     * @param \Illuminate\Http\Request           $request
     * @param \Cortex\Categories\Models\Category $category
     *
     * @return \Illuminate\View\View
     */
    protected function form(Request $request, Category $category)
    {
        if (! $category->exists && $request->has('replicate') && $replicated = $category->resolveRouteBinding($request->input('replicate'))) {
            $category = $replicated->replicate();
        }

        $ParentCategories = app('rinvex.categories.category')->pluck('name', 'id');

        return view('cortex/categories::adminarea.pages.category', compact('category', 'ParentCategories'));
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
     * @param \Cortex\Foundation\Http\FormRequest $request
     * @param \Cortex\Categories\Models\Category  $category
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
            'url' => route('adminarea.cortex.categories.categories.index'),
            'with' => ['success' => trans('cortex/foundation::messages.resource_saved', ['resource' => trans('cortex/categories::common.category'), 'identifier' => $category->getRouteKey()])],
        ]);
    }

    /**
     * Destroy given category.
     *
     * @param \Cortex\Categories\Models\Category $category
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return intend([
            'url' => route('adminarea.cortex.categories.categories.index'),
            'with' => ['warning' => trans('cortex/foundation::messages.resource_deleted', ['resource' => trans('cortex/categories::common.category'), 'identifier' => $category->getRouteKey()])],
        ]);
    }
}
