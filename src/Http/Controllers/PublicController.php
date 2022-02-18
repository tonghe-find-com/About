<?php

namespace Tonghe\Modules\Abouts\Http\Controllers;

use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use Tonghe\Modules\Abouts\Models\About;

class PublicController extends BasePublicController
{
    public function index()
    {
        $model = About::published()->orderBy('position', 'ASC')->first();
        if($model){
            return redirect($model->url());
        }else{
            return redirect()->back();
        }
    }

    public function show($slug): View
    {
        $model = About::published()->whereSlugIs($slug)->firstOrFail();

        return view('abouts::public.show')
            ->with(compact('model'));
    }
}
