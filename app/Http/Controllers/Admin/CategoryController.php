<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\AddCategoryRequest;
use App\Http\Requests\Category\EditCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $categories = Category::where('parent_id', 0)->get();

        return view('backend.category.index', compact('categories'));

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('backend.category.create');
    }

    /**
     * @param AddCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AddCategoryRequest $request)
    {
        $data = $request->all();

        // save img category
        if (!empty($data['image'])) {
            $image = $this->uploadImage($request['image']);
        }

        $data['image'] = !empty($image) ? $image : null;
        $data['status'] = 1;
        $data['parent_id'] = 0;
        Category::create($data);

        return redirect()->route('admin.category.index')->with('success', 'Category created successfully.');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $category = Category::find($id);
        $category_mid = Category::where('parent_id', $id)->get();

        return view('backend.category.show', compact('category', 'category_mid'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $category = Category::find($id);

        return view('backend.category.edit', compact('category'));
    }

    /**
     * @param EditCategoryRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditCategoryRequest $request, $id)
    {
        $data = $request->all();
        $category = Category::find($id);

        if (!empty($request['image'])) {
            $image = $this->uploadImage($request['image']);
            // delete img old
            \File::delete(public_path() . '/' . $category['image']);
        }

        $data['image'] = !empty($image) ? $image : $category['image'];
        $category->update($data);

        return redirect()->route('admin.category.index')->with('success', 'Update category success');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        // delete image
        \File::delete(public_path() . '/' . $category['image']);
        $category->delete();

        return redirect()->route('admin.category.index')->with('success', 'Delete category success');
    }

    /**
     * @param $image
     * @return string
     */
    public function uploadImage($image)
    {
        $name = time() . '.' . $image->getClientOriginalExtension();
        $image->move('picture', $name);
        return sprintf('picture/%s', $name);
    }

    public function showMid($id)
    {
        $category = Category::find($id);

        return view('backend.category.mid.show', compact('category'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createMid($id)
    {
        $category = Category::find($id);

        return view('backend.category.mid.create', compact('category'));
    }

    /**
     * @param AddCategoryRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeMid(AddCategoryRequest $request, $id)
    {
        $data = $request->all();
        $data['parent_id'] = $id;
        if (!empty($request['image'])) {
            $image = $this->uploadImage($request['image']);
        }

        $data['image'] = !empty($image) ? $image : null;
        $data['status'] = 1;
        Category::create($data);

        return redirect()->route('admin.category.show', $id)->with('success', 'Category created successfully.');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function editMid($id)
    {
        $category = Category::find($id);

        return view('backend.category.mid.edit', compact('category'));
    }

    public function updateMid(EditCategoryRequest $request, $id)
    {
        $category = Category::find($id);
        $category_parent_id = $category->parent_id;
        $data = $request->all();
        if (!empty($request['image'])) {
            $image = $this->uploadImage($request['image']);

            // delete img old
            \File::delete(public_path() . '/' . $category['image']);
        }

        $data['image'] = !empty($image) ? $image : $category['image'];
        $category->update($data);

        return redirect()->route('admin.category.show', $category_parent_id)->with('success', 'Category update success');
    }
}
