<?php

namespace TypiCMS\Modules\Abouts\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Abouts\Exports\Export;
use TypiCMS\Modules\Abouts\Http\Requests\FormRequest;
use TypiCMS\Modules\Abouts\Models\About;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('abouts::admin.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d').' '.config('app.name').' abouts.xlsx';

        return Excel::download(new Export($request), $filename);
    }

    public function create(): View
    {
        $model = new About();

        return view('abouts::admin.create')
            ->with(compact('model'));
    }

    public function edit(about $about): View
    {
        return view('abouts::admin.edit')
            ->with(['model' => $about]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $about = About::create($request->validated());

        return $this->redirect($request, $about);
    }

    public function update(about $about, FormRequest $request): RedirectResponse
    {
        $about->update($request->validated());

        return $this->redirect($request, $about);
    }
}
