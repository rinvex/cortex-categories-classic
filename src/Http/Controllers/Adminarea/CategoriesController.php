<?php

declare(strict_types=1);

namespace Cortex\Categories\Http\Controllers\Adminarea;

use Exception;
use Illuminate\Http\Request;
use Cortex\Categories\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Cortex\Foundation\DataTables\LogsDataTable;
use Cortex\Foundation\Importers\DefaultImporter;
use Cortex\Foundation\DataTables\ImportLogsDataTable;
use Cortex\Foundation\Http\Requests\ImportFormRequest;
use Cortex\Foundation\DataTables\ImportRecordsDataTable;
use Cortex\Foundation\Http\Controllers\AuthorizedController;
use Cortex\Categories\DataTables\Adminarea\CategoriesDataTable;
use Cortex\Categories\Http\Requests\Adminarea\CategoryFormRequest;

class CategoriesController extends AuthorizedController
{
    /**
     * {@inheritdoc}
     */
    protected $resource = Category::class;

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
     * @param \Cortex\Categories\Models\Category                   $category
     * @param \Cortex\Foundation\DataTables\ImportRecordsDataTable $importRecordsDataTable
     *
     * @return \Illuminate\View\View
     */
    public function import(Category $category, ImportRecordsDataTable $importRecordsDataTable)
    {
        return $importRecordsDataTable->with([
            'resource' => $category,
            'tabs' => 'adminarea.cortex.categories.categories.tabs',
            'url' => route('adminarea.cortex.categories.categories.stash'),
            'id' => "adminarea-cortex-categories-categories-{$category->getRouteKey()}-import",
        ])->render('cortex/foundation::adminarea.pages.datatable-dropzone');
    }

    /**
     * Stash categories.
     *
     * @param \Cortex\Foundation\Http\Requests\ImportFormRequest $request
     * @param \Cortex\Foundation\Importers\DefaultImporter       $importer
     *
     * @return void
     */
    public function stash(ImportFormRequest $request, DefaultImporter $importer)
    {
        // Handle the import
        $importer->config['resource'] = $this->resource;
        $importer->handleImport();
    }

    /**
     * Hoard categories.
     *
     * @param \Cortex\Foundation\Http\Requests\ImportFormRequest $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function hoard(ImportFormRequest $request)
    {
        foreach ((array) $request->get('selected_ids') as $recordId) {
            $record = app('cortex.foundation.import_record')->find($recordId);

            try {
                $fillable = collect($record['data'])->intersectByKeys(array_flip(app('rinvex.categories.category')->getFillable()))->toArray();

                tap(app('rinvex.categories.category')->firstOrNew($fillable), function ($instance) use ($record) {
                    $instance->save() && $record->delete();
                });
            } catch (Exception $exception) {
                $record->notes = $exception->getMessage().(method_exists($exception, 'getMessageBag') ? "\n".json_encode($exception->getMessageBag())."\n\n" : '');
                $record->status = 'fail';
                $record->save();
            }
        }

        return intend([
            'back' => true,
            'with' => ['success' => trans('cortex/foundation::messages.import_complete')],
        ]);
    }

    /**
     * List category import logs.
     *
     * @param \Cortex\Foundation\DataTables\ImportLogsDataTable $importLogsDatatable
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function importLogs(ImportLogsDataTable $importLogsDatatable)
    {
        return $importLogsDatatable->with([
            'resource' => trans('cortex/categories::common.category'),
            'tabs' => 'adminarea.cortex.categories.categories.tabs',
            'id' => 'adminarea-cortex-categories-categories-import-logs',
        ])->render('cortex/foundation::adminarea.pages.datatable-tab');
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
        $ParentCategories = app('rinvex.categories.category')->pluck('name','id');

        return view('cortex/categories::adminarea.pages.category', compact('category','ParentCategories'));
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
