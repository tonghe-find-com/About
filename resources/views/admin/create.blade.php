@extends('core::admin.master')

@section('title', __('New about'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'abouts'])
        <h1 class="header-title">@lang('New about')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-abouts'))->multipart()->role('form') !!}
        @include('abouts::admin._form')
    {!! BootForm::close() !!}

@endsection
