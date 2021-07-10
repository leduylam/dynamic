<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MultiLanguageController extends Controller
{
    /**
     * @param $locale
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index(Request $request, $locale)
    {
        if ($locale) {
            $request->session()->put('website_language', $locale);
        }

        return redirect()->back();
    }
}
