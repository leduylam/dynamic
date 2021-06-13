<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $sizes = Size::all();

        return view('backend.size.index', compact('sizes'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('backend.size.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validateSize($request);
        $data = $request->all();
        Size::create($data);

        return redirect()->route('admin.size.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $size = Size::find($id);

        return view('backend.size.edit', compact('size'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->validateSize($request);
        $size = Size::find($id);
        $data = $request->all();
        $size->update($data);

        return redirect()->route('admin.size.index')->with('success', 'Category updated successfully.');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $size = Size::find($id);
        $size->delete();

        return redirect()->back()->with('success', 'Delete size successfully');
    }

    /**
     * Override validate method
     * @param Request $request
     */
    public function validateSize(Request $request)
    {
        $request->validate([
            'size' => 'required|string|max:255',
        ]);
    }
}
