<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $colors = Color::all();

        return view('backend.color.index', compact('colors'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('backend.color.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validateColor($request);
        $data = $request->all();
        Color::create($data);

        return redirect()->route('admin.color.index')->with('success', 'Color created successfully.');
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
        $color = Color::find($id);

        return view('backend.color.edit', compact('color'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->validateColor($request);
        $color = Color::find($id);
        $data = $request->all();
        $color->update($data);

        return redirect()->route('admin.color.index')->with('success','Color updated successfully.');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $color = Color::find($id);
        $color->delete();

        return redirect()->back()->with('success', 'Delete color successfully');
    }

    /**
     * Override validate method
     * @param Request $request
     */
    public function validateColor(Request $request)
    {
        $request->validate([
            'color' => 'required|string|max:255',
        ]);
    }
}
