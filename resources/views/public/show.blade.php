@extends('pages::public.master')

@section('title',$page->meta_title==""?$page->title:$page->meta_title)
@section('keywords',$page->meta_keywords)
@section('description',$page->meta_description)

@push('css')
    <!-- $$$ Single CSS $$$ -->
    <link rel="stylesheet" href="/project/css/wrapper.min.css">
@endpush

@push('js')
    <!-- $$$ Single JS $$$ -->
    <script defer src=""></script>
    <script>
        $currentpage = "ABOUT"
    </script>
@endpush

@section('content')
<section>

    <nav aria-label="breadcrumb" class="breadcrumbrow">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ TypiCMS::homeUrl() }}"><i class="fas fa-home"></i>{{ Pages::getHomeTitle() }}</a></li>
                <li aria-current="page" class="breadcrumb-item active">{{$page->title}}</li>
            </ol>
        </div>
    </nav>

    @include('template.banner',['page_name'=>'about'])

    <div class="wrapper-about wrapper-A">
        <div class="container">
            <h1 class="heading">
                {{$model->title}}
            </h1>
            <div class="block-about">
                @if($model->body)
                    {!! $model->body !!}
                @else
                <img src="/project/images/aboutpic1.png" alt="">
                <br>
                <p>
                    東聖機械是台灣專業自動化工具機貿易商之一，代理多家台灣和日本知名設備工具機及自動化元件， 至今已邁入30 年，代理之日本傳動和連桿之汽機車, 精密零部件（洗切削、內外徑平面鏡面和汽缸研磨等），金屬機械加工生產設備供應商，及精密減速機（微型）齒輪、螺桿、軸承模具等機械加工自動化生產設備（車床、銑床、鑽孔攻牙、磨床、拉床等），及多家日本原材料、試驗機檢測設備裝置，超音波、渦流探傷、X光設限等各式無損探傷檢出設備，產品線繁不及備載。
                </p>
                @endif
            </div>

        </div>
    </div>

</section>
@endsection
