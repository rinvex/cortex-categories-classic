<?php

declare(strict_types=1);

namespace Cortex\Categorizable\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Cortex\Categorizable\Models\Category;
use Cortex\Foundation\Http\Controllers\AuthorizedController;
use Cortex\Categorizable\DataTables\Backend\CategoriesDataTable;
use Cortex\Categorizable\Http\Requests\Backend\CategoryFormRequest;

class CategoriesController extends AuthorizedController
{
    /**
     * {@inheritdoc}
     */
    protected $resource = 'categories';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return app(CategoriesDataTable::class)->render('cortex/foundation::backend.partials.datatable', ['resource' => 'cortex/categorizable::common.categories']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Backend\CategoryFormRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryFormRequest $request)
    {
        return $this->process($request, new Category());
    }

    /**
     * Update the given resource in storage.
     *
     * @param \App\Http\Requests\Backend\CategoryFormRequest $request
     * @param \Cortex\Categorizable\Models\Category          $category
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryFormRequest $request, Category $category)
    {
        return $this->process($request, $category);
    }

    /**
     * Delete the given resource from storage.
     *
     * @param \Cortex\Categorizable\Models\Category $category
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Category $category)
    {
        $category->delete();

        return intend([
            'url' => route('backend.categories.index'),
            'with' => ['warning' => trans('cortex/categorizable::messages.category.deleted', ['categoryId' => $category->id])],
        ]);
    }

    /**
     * Show the form for create/update of the given resource.
     *
     * @param \Cortex\Categorizable\Models\Category $category
     *
     * @return \Illuminate\Http\Response
     */
    public function form(Category $category)
    {
        return view('cortex/categorizable::backend.forms.category', compact('category'));
    }

    /**
     * Process the form for store/update of the given resource.
     *
     * @param \Illuminate\Http\Request              $request
     * @param \Cortex\Categorizable\Models\Category $category
     *
     * @return \Illuminate\Http\Response
     */
    protected function process(Request $request, Category $category)
    {
        // Prepare required input fields
        $data = $request->all();

        // Save category
        $category->fill($data)->save();

        return intend([
            'url' => route('backend.categories.index'),
            'with' => ['success' => trans('cortex/categorizable::messages.category.saved', ['categoryId' => $category->id])],
        ]);
    }
}
