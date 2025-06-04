@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="col-md-12 ">
            <ol class="breadcrumb">
                <li><a href="{{route('web.admin.home')}}">داشبورد</a></li>
                <li><a href="{{route('web.admin.setting.admin.index')}}">لیست تنظیمات</a></li>
                <li class="active">ایجاد تنظیمات</li>
            </ol>
        </div>
    </div>

    <form method="post" action="{{route('web.admin.setting.admin.update',$admin->id)}}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="row white z-depth-1">
            <div class="col-md-12">
                <span class="blue-grey darken-2 white-text title z-depth-2">ویرایش تنظیمات</span>
                @include('share.extra.back2',['route'=>route('web.admin.setting.admin.index')])
            </div>

            <div class="col-md-6">
                @include('share.forms.select',['name'=>'category_id','title'=>'دسته بندی','options'=>$settingCat,'selected'=>$admin->category_id])
            </div>
            <div class="col-md-6">
                @include('share.forms.select',['name'=>'type','title'=>'نوع',
                'options'=>['string'=>'string','file'=>'file','boolean'=>'boolean','textarea'=>'textarea','editor'=>'editor','movie'=>'movie','movieSingle'=>'movieSingle','category'=>'category','category'=>'categorySingle',],'selected'=>$admin->type])
            </div>
            <div class="clearfix"></div>
            <div class="col-md-6">
                @include('share.forms.input',['name'=>'title','title'=>'تیتر','value'=>$admin->title])
            </div>
            <div class="col-md-6">
                @include('share.forms.input',['name'=>'name','class'=>'dleft','title'=>'نام','value'=>$admin->name])
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12">
                @include('share.forms.input',['name'=>'value','title'=>'مقدار','class'=>'dleft','value'=>$admin->value])
            </div>
            <div class="col-md-6">
                @include('share.forms.switch',['name'=>'linkable','title'=>'لینک','checked'=>$admin->linkable])
            </div>
            <div class="col-md-6">
                @include('share.forms.switch',['name'=>'status','title'=>'فعال','checked'=>$admin->status])
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12 mb20 mt20 ">
                <button class="waves-effect waves-light btn quarter center-block blue-grey darken-2">ویرایش</button>
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
