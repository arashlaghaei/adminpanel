@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="col-md-12 ">
            <ol class="breadcrumb">
                <li><a href="{{route('web.admin.home')}}">داشبورد</a></li>
                <li><a href="{{route('web.admin.setting.category.index')}}">لیست دسته بندی تنظیمات</a></li>
                <li class="active">ایجاد دسته بندی</li>
            </ol>
        </div>
    </div>

    <form method="post" action="{{route('web.admin.setting.category.store')}}">
        {{ csrf_field() }}
        <div class="row white z-depth-1">
            <div class="col-md-12">
                <span class="blue-grey darken-2 white-text title z-depth-2">ایجاد دسته بندی تنظیمات</span>
                @include('share.extra.back2',['route'=>route('web.admin.setting.category.store')])
            </div>

            <div class="col-md-6">
                @include('share.forms.input',['name'=>'title','title'=>'تیتر'])
            </div>
            <div class="col-md-6">
                @include('share.forms.input',['name'=>'order','title'=>'موقعیت','class'=>'dleft','value' => $order])
            </div>
            <div class="col-md-6 mt35">
                @include('share.forms.switch',['name'=>'status','title'=>'فعال','checked'=>1])
            </div>

            <div class="col-md-12 mb20 mt20 ">
                <button class="waves-effect waves-light btn quarter center-block blue darken-1">ایجاد</button>
            </div>

        </div>
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('select').material_select();
        });
    </script>
@endpush
