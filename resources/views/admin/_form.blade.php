@push('js')
    <script src="{{ asset('components/ckeditor4/ckeditor.js') }}"></script>
    <script src="{{ asset('components/ckeditor4/config-full.js') }}"></script>
@endpush

@component('core::admin._buttons-form', ['model' => $model])
@endcomponent

{!! BootForm::hidden('id') !!}


<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" href="#tab-content" data-bs-toggle="tab">{{ __('Content') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#tab-meta" data-bs-toggle="tab">{{ __('Meta') }}</a>
    </li>
</ul>

<div class="tab-content">
    <div class="tab-pane fade show active" id="tab-content">
        @include('core::form._title-and-slug')
        <div class="mb-3">
            {!! TranslatableBootForm::hidden('status')->value(0) !!}
            {!! TranslatableBootForm::checkbox(__('Published'), 'status') !!}
        </div>
        {!! TranslatableBootForm::textarea(__('Body'), 'body')->addClass('ckeditor-full') !!}
        <hr>
        {!! BootForm::textarea(__('Example'), 'example')->addClass('ckeditor-full')->value(' <img src="/project/images/aboutpic1.png" alt="">
        <br>
        <p>
            東聖機械是台灣專業自動化工具機貿易商之一，代理多家台灣和日本知名設備工具機及自動化元件， 至今已邁入30 年，代理之日本傳動和連桿之汽機車, 精密零部件（洗切削、內外徑平面鏡面和汽缸研磨等），金屬機械加工生產設備供應商，及精密減速機（微型）齒輪、螺桿、軸承模具等機械加工自動化生產設備（車床、銑床、鑽孔攻牙、磨床、拉床等），及多家日本原材料、試驗機檢測設備裝置，超音波、渦流探傷、X光設限等各式無損探傷檢出設備，產品線繁不及備載。
        </p>')->disable() !!}
    </div>
    <div class="tab-pane fade" id="tab-meta">
        {!! TranslatableBootForm::text(__('Meta title'), 'meta_title') !!}
        {!! TranslatableBootForm::text(__('Meta keywords'), 'meta_keywords') !!}
        {!! TranslatableBootForm::text(__('Meta description'), 'meta_description') !!}
    </div>
</div>
