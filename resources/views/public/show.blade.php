@extends('pages::public.master')

@section('title',$page->meta_title==""?$page->title:$page->meta_title)
@section('keywords',$page->meta_keywords)
@section('description',$page->meta_description)

@push('css')
    <!-- 置入CSS -->
@endpush

@push('js')
    <!-- 置入JS -->
@endpush

@section('content')
<h1>
{{$model->title}}
</h1>
{!! $model->body !!}
@endsection
