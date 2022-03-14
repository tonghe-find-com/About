<?php

namespace TypiCMS\Modules\Abouts\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Abouts\Models\About;

class ApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(About::class)
            ->selectFields($request->input('fields.abouts'))
            ->allowedSorts(['status_translated', 'title_translated', 'position'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->input('per_page'));

        return $data;
    }

    protected function updatePartial(About $about, Request $request)
    {
        foreach ($request->only('status', 'position') as $key => $content) {
            if ($about->isTranslatableAttribute($key)) {
                foreach ($content as $lang => $value) {
                    $about->setTranslation($key, $lang, $value);
                }
            } else {
                $about->{$key} = $content;
            }
        }

        $about->save();
    }

    public function destroy(About $about)
    {
        $about->delete();
    }
}
