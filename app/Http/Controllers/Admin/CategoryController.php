<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EditAdminRequest;
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
        $categories = Category::where('parent_id_1', 0)->where('parent_id_2', 0)->get();

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
        $data['parent_id_1'] = 0;
        $data['parent_id_2'] = 0;
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
        $category_mid = Category::where('parent_id_1', $id)->where('parent_id_2', 0)->get();

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

        return redirect()->route('admin.category.index')->with('success', 'Update category successfully');
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

        return redirect()->route('admin.category.index')->with('success', 'Delete category successfully');
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
        $category_small = Category::where('parent_id_1', $category['parent_id_1'])->where('parent_id_2', $category->id)->get();

        return view('backend.category.mid.show', compact('category', 'category_small'));
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
        $data['parent_id_1'] = $id;
        if (!empty($request['image'])) {
            $image = $this->uploadImage($request['image']);
        }

        $data['image'] = !empty($image) ? $image : null;
        $data['status'] = 1;
        $data['parent_id_2'] = 0;
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

    /**
     * @param EditCategoryRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateMid(EditCategoryRequest $request, $id)
    {
        $category = Category::find($id);
        $category_parent_id = $category->parent_id_1;
        $data = $request->all();
        if (!empty($request['image'])) {
            $image = $this->uploadImage($request['image']);

            // delete img old
            \File::delete(public_path() . '/' . $category['image']);
        }

        $data['image'] = !empty($image) ? $image : $category['image'];
        $category->update($data);

        return redirect()->route('admin.category.show', $category_parent_id)->with('success', 'Category update successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createSmall($id)
    {
        $category = Category::find($id);
        $category_big = Category::find($category->parent_id_1)->first();

        return view('backend.category.small.create', compact('category', 'category_big'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showSmall($id) {
        $category = Category::find($id);

        return view('backend.category.small.show', compact('category'));
    }

    /**
     * @param AddCategoryRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeSmall(AddCategoryRequest $request, $id)
    {
        $data = $request->all();
        $category = Category::find($id);
        if (!empty($request['image'])) {
            $image = $this->uploadImage($request['image']);
        }

        $data['parent_id_1'] = $category['parent_id_1'];
        $data['parent_id_2'] = $category->id;
        $data['image'] = !empty($image) ? $image : null;
        $data['status'] = true;
        Category::create($data);

        return redirect()->route('admin.category.show.mid', $id)->with('success', 'Category created successfully.');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function editSmall($id)
    {
        $category = Category::find($id);
        $category_big = Category::where('id', $category->parent_id_1)->first();
        $category_mid = Category::where('id', $category->parent_id_2)->first();

        return view('backend.category.small.edit', compact('category', 'category_mid', 'category_big'));
    }

    /**
     * @param EditAdminRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSmall(EditCategoryRequest $request, $id)
    {
        $category = Category::find($id);
        $parent_mid_id = $category['parent_id_2'];
        $data = $request->all();
        if (!empty($request['image'])) {
            $image = $this->uploadImage($request['image']);

            // delete img old
            \File::delete(public_path() . '/' . $category['image']);
        }

        $data['image'] = !empty($image) ? $image : $category['image'];
        $category->update($data);

        return redirect()->route('admin.category.show.mid', $parent_mid_id)->with('success', 'Category update successfully.');
    }

    /**
     * @param Request $request
     * @return array
     */
    public function listCategoryMid(Request $request)
    {
        $categories = [];
        if ($request->ajax()) {
            $categories = Category::where('parent_id_1', $request['category_id'])->where('parent_id_2', 0)->get();
        }

        return $categories;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function listCategorySmall(Request $request)
    {
        $categories = [];
        if ($request->ajax()) {
            $categories = Category::where('parent_id_1', $request['category_id_1'])->where('parent_id_2', $request['category_id_2'])->get();
        }

        return $categories;
    }
}
