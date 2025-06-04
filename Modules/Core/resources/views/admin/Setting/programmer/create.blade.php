@extends('admin.layout.master')

@section('content')
    <form method="post" action="{{route('web.admin.setting.programmer.store')}}">
        {{ csrf_field() }}
        <div class="row white z-depth-1">
            <div class="col-md-12 mb20">
                <span class="blue-grey darken-2 white-text title z-depth-2">تنظیمات برنامه نویس</span>
            </div>

            <div class="clearfix mt20"></div>
            <div class="col-md-3">
                @include('share.forms.switch',['name'=>'migratefresh','title'=>'Migrate Fresh','checked'=>0])
            </div>
            <div class="col-md-3">
                @include('share.forms.switch',['name'=>'migrate','title'=>'Migrate','checked'=>0])
            </div>
            <div class="col-md-3">
                @include('share.forms.switch',['name'=>'migrateall','title'=>'Migrate All','checked'=>0])
            </div>
            <div class="col-md-3">
                @include('share.forms.switch',['name'=>'dbseed','title'=>'DB seed','checked'=>0])
            </div>
            <div class="clearfix mt20"></div>


            <div class="col-md-8 col-md-offset-2 mb20 mt20">
                <h4 class="blue darken-3 white-text br4 pd1 z-depth-1 text-center">Cache</h4>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-3">
                @include('share.forms.switch',['name'=>'routeclear','title'=>'Route clear','checked'=>0])
            </div>
            <div class="col-md-3">
                @include('share.forms.switch',['name'=>'routecache','title'=>'Route cache','checked'=>0])
            </div>

            <div class="col-md-3">
                @include('share.forms.switch',['name'=>'viewclear','title'=>'View clear','checked'=>0])
            </div>
            <div class="col-md-3">
                @include('share.forms.switch',['name'=>'viewcache','title'=>'View cache','checked'=>0])
            </div>
            <div class="clearfix"></div>

            <div class="col-md-3">
                @include('share.forms.switch',['name'=>'configclear','title'=>'Config clear','checked'=>0])
            </div>
            <div class="col-md-3">
                @include('share.forms.switch',['name'=>'configcache','title'=>'Config cache','checked'=>0])
            </div>

            <div class="col-md-3">
                @include('share.forms.switch',['name'=>'optimizeclear','title'=>'Optimize clear','checked'=>0])
            </div>
            <div class="col-md-3">
                @include('share.forms.switch',['name'=>'optimizecache','title'=>'Optimize','checked'=>0])
            </div>
            <div class="clearfix"></div>

            <div class="col-md-3">
                @include('share.forms.switch',['name'=>'authclear','title'=>'Auth clear','checked'=>0])
            </div>
            <div class="col-md-3">
                @include('share.forms.switch',['name'=>'cacheclear','title'=>'Cache clear','checked'=>0])
            </div>




            <div class="clearfix"></div>
            <div class="col-md-12 mb20 mt20 ">
                <button class="waves-effect waves-light btn quarter center-block blue darken-1">ثبت</button>
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
