@extends('admin.layout.master')

@section('content')
    <form method="post" action="{{route('web.admin.setting.settings.store')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row white z-depth-1">

            <div class="col-md-12 pd4">
                <div class="col-md-12 pd0 mb10">
                    <ul class="tabs blue-grey darken-2 z-depth-2">
                        @foreach($list as $category)
                            @if($loop->first)
                                <li class="tab"><a class="active" href="#test{{$loop->index}}">{{$category->title}}</a></li>
                            @else
                                <li class="tab"><a href="#test{{$loop->index}}">{{$category->title}}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>

            @foreach($list as $category)
                <div id="test{{$loop->index}}" class="col s12">
                    @foreach($category->settingsAdmin as $key => $value)

                        @if($value->type == 'string')
                            @if($value->linkable)
                                <div class="col-md-12 pd4 mt20">
                                    <div class="col-md-6">
                                        {!! view('share.forms.input',
                                        ['name' => "string[$value->id][value]", 'title' => $value->title,'value'=>isset($value->settings->value)?$value->settings->value:'']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! view('share.forms.input',
                                       ['name' => "string[$value->id][link]", 'title' => 'لینک','class'=>'dleft','value'=>isset($value->settings->link)?$value->settings->link:'']) !!}
                                    </div>
                                </div>
                            @else
                                <div class="col-md-12 mt20">
                                    {!! view('share.forms.input',
                                    ['name' => "string[$value->id][value]", 'title' => $value->title,'class'=>$value->class,'value'=>isset($value->settings->value)?$value->settings->value:'']) !!}
                                </div>
                            @endif
                        @endif

                        @if($value->type == 'boolean')
                            <div class="col-md-6 mt20">
                                {!! view('share.forms.switch',
                                ['name' => "boolean[$value->id][value]", 'title' => $value->title,'checked'=>isset($value->settings->value)?$value->settings->value:0]) !!}
                            </div>
                        @endif

                        @if($value->type == 'movie')
                            <div class="col-md-12 mt20">
                                <label for="movie{{$value->id}}">{{$value->title}}</label>
                                <select id="movie{{$value->id}}" name="movie[{{$value->id}}][value][]" multiple="multiple" class="movie">
                                    @if(isset($value->settings->value))
                                        @foreach(\App\Models\Movie\Movie::whereIn('id',json_decode($value->settings->value))->get() as $movie)
                                            <option selected="selected" value="{{$movie->id}}">{{$movie->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        @endif

                        @if($value->type == 'series')
                            <div class="col-md-12 mt20">
                                <label for="series{{$value->id}}">{{$value->title}}</label>
                                <select id="series{{$value->id}}" name="series[{{$value->id}}][value][]" multiple="multiple" class="series">
                                    @if(isset($value->settings->value))
                                        @foreach(\App\Models\Series\Series::whereIn('id',json_decode($value->settings->value))->get() as $series)
                                            <option selected="selected" value="{{$series->id}}">{{$series->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        @endif

                        @if($value->type == 'articleCategory')
                            <div class="col-md-12 mt20">
                                <label for="articlecategory{{$value->id}}">{{$value->title}}</label>
                                <select id="articlecategory{{$value->id}}" name="articlecategory[{{$value->id}}][value][]" class="articlecategory">
                                    @if(isset($value->settings->value))
                                        @foreach(\App\Models\Article\articleCategory::whereIn('id',json_decode($value->settings->value))->get() as $article)
                                            <option selected="selected" value="{{$article->id}}">{{$article->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        @endif

                        @if($value->type == 'articleSingle')
                                <div class="col-md-12 mt20">
                                    <label for="article{{$value->id}}">{{$value->title}}</label>
                                    <select id="article{{$value->id}}" name="article[{{$value->id}}][value][]" class="article-single">
                                        @if(isset($value->settings->value))
                                            @foreach(\App\Models\Article\article::whereIn('id',json_decode($value->settings->value))->get() as $article)
                                                <option selected="selected" value="{{$article->id}}">{{$article->title}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            @endif

                        @if($value->type == 'textarea')
                            <div class="col-md-12 mt20">
                                {!! view('share.forms.textarea-Material',
                                ['name' => "textarea[$value->id][value]", 'title' => $value->title,'value'=>isset($value->settings->value)?$value->settings->value:'']) !!}
                            </div>
                        @endif

                        @if($value->type == 'editor')
                            <div class="col-md-12 mt20">
                                <label>{{$value->title}}</label>
                                {!! view('share.forms.textarea',
                                ['name' => "editor[$value->id][value]", 'title' => $value->title,'class'=>'editor','value'=>isset($value->settings->value)?$value->settings->value:'']) !!}
                            </div>
                        @endif

                        @if($value->type == 'file')
                            <div class="col-md-12 mt20"></div>
                            @if($value->linkable)
                                <div class="col-md-6">
                                    <div class="file-field input-field">
                                        <div class="btn blue-grey darken-2">
                                            <span>{{$value->title}}</span>
                                            <input name="{{"files[$value->id]"}}" type="file">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path validate" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    @if(isset($value->settings->link))
                                        {!! view('share.forms.input',
                                        ['name' => "string[$value->id][link]",'class'=>'dleft','title' => 'لینک','value'=>$value->settings->link]) !!}
                                    @else
                                        {!! view('share.forms.input',
                                        ['name' => "string[$value->id][link]",'class'=>'dleft','title' => 'لینک']) !!}
                                    @endif
                                </div>
                            @else
                                <div class="col-md-12 mt20">
                                    <div class="file-field input-field">
                                        <div class="btn blue-grey darken-2">
                                            <span>{{$value->title}}</span>
                                            <input name="{{"files[$value->id]"}}" type="file">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path validate" type="text">
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if(isset($value->settings->value))
                                <div class="col-md-12">
                                    <img src="{{asset($value->settings->value)}}" class="img-responsive photo z-depth-2">
                                </div>
                            @endif
                            <div class="col-md-12 mb20"></div>
                        @endif

                    @endforeach
                </div>
            @endforeach

            @if($list->count())
                <div class="col-md-12 mb20 mt20 ">
                    <button class="waves-effect waves-light btn quarter center-block blue-grey darken-2">ذخیره</button>
                </div>
            @else
                <div class="col-md-12 mt20 mb30">
                    <h4 class="text-center">تنظیماتی موجود نیست</h4>
                </div>
            @endif

        </div>
    </form>
@endsection

@push('scripts')
    <script src="{{asset('assets/plugins/ck4/ckeditor.js')}}"></script>
    <script src="{{asset('assets/plugins/ck4/config.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/select2.js')}}"></script>

    <script>
        $(document).ready(function() {
            $('.movie').select2({
                dir:'rtl',
                closeOnSelect:false,
                multiple:true,
                minimumInputLength: 1,
                ajax: {
                    url: '/api/admin/v1/movie/movie',
                    dataType: 'json',
                    headers: {Authorization: 'Bearer ' + document.getElementById('ap_tkn').innerText},
                    data: function (params) {
                        return {
                            query: params.term,
                            page : params.page
                        };
                    },
                    processResults: function (data,params) {
                        params.page = params.page || 1;
                        return {
                            results: data.data,
                            pagination: {
                                more : (params.page  * 10) < data.total
                            }
                        };
                    },
                    delay: 250,
                    type:'GET',
                },
                templateResult: function (repo) {
                    return repo.id + ' - ' + repo.title;
                },
                templateSelection: function (repo) {
                    if (repo.title) {
                        return repo.id + ' - ' + repo.title;
                    } else {
                        return repo.id + ' - ' + repo.text;
                    }
                },
            });
            $('.series').select2({
                dir:'rtl',
                closeOnSelect:false,
                multiple:true,
                minimumInputLength: 1,
                ajax: {
                    url: '/api/admin/v1/series/series',
                    dataType: 'json',
                    headers: {Authorization: 'Bearer ' + document.getElementById('ap_tkn').innerText},
                    data: function (params) {
                        return {
                            query: params.term,
                            page : params.page
                        };
                    },
                    processResults: function (data,params) {
                        params.page = params.page || 1;
                        return {
                            results: data.data,
                            pagination: {
                                more : (params.page  * 10) < data.total
                            }
                        };
                    },
                    delay: 250,
                    type:'GET',
                },
                templateResult: function (repo) {
                    return repo.id + ' - ' + repo.title;
                },
                templateSelection: function (repo) {
                    if (repo.title) {
                        return repo.id + ' - ' + repo.title;
                    } else {
                        return repo.id + ' - ' + repo.text;
                    }
                },
            });
            $('.articlecategory').select2({
                dir:'rtl',
                closeOnSelect:false,
                minimumInputLength: 1,
                ajax: {
                    url: '/api/admin/v1/article/category',
                    dataType: 'json',
                    headers: {Authorization: 'Bearer ' + document.getElementById('ap_tkn').innerText},
                    data: function (params) {
                        return {
                            query: params.term,
                            page : params.page
                        };
                    },
                    processResults: function (data,params) {
                        params.page = params.page || 1;
                        return {
                            results: data.data,
                            pagination: {
                                more : (params.page  * 10) < data.total
                            }
                        };
                    },
                    delay: 250,
                    type:'GET',
                },
                templateResult: function (repo) {
                    return repo.id + ' - ' + repo.title;
                },
                templateSelection: function (repo) {
                    if (repo.title) {
                        return repo.id + ' - ' + repo.title;
                    } else {
                        return repo.id + ' - ' + repo.text;
                    }
                },
            });
            $('.article-single').select2({
                dir:'rtl',
                closeOnSelect:true,
                multiple:false,
                minimumInputLength: 1,
                ajax: {
                    url: '/api/admin/v1/article/article',
                    dataType: 'json',
                    headers: {Authorization: 'Bearer ' + document.getElementById('ap_tkn').innerText},
                    data: function (params) {
                        return {
                            query: params.term,
                            page : params.page
                        };
                    },
                    processResults: function (data,params) {
                        params.page = params.page || 1;
                        return {
                            results: data.data,
                            pagination: {
                                more : (params.page  * 10) < data.total
                            }
                        };
                    },
                    delay: 250,
                    type:'GET',
                },
                templateResult: function (repo) {
                    return repo.id + ' - ' + repo.title;
                },
                templateSelection: function (repo) {
                    if (repo.title) {
                        return repo.id + ' - ' + repo.title;
                    } else {
                        return repo.id + ' - ' + repo.text;
                    }
                },
            });

            CKEDITOR.replaceClass = 'editor';
            CKEDITOR.config.filebrowserImageBrowseUrl = '/laravel-filemanager?type=Images';
            CKEDITOR.config.filebrowserImageUploadUrl = '/laravel-filemanager/upload?type=Images&_token=';
            CKEDITOR.config.filebrowserBrowseUrl = '/laravel-filemanager?type=Files';
            CKEDITOR.config.filebrowserUploadUrl = '/laravel-filemanager/upload?type=Files&_token=';
        });

    </script>
@endpush

@push('styles')
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.css')}}">

    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #41b883 !important;
            padding: 2px 8px 2px 16px !important;

        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #266d4d !important;
            cursor: pointer !important;
            display: inline-block !important;
            font-weight: bold !important;
            margin-right: 2px !important;
        }

        .tabs .tab a ,.tabs .tab a.active, .tabs .tab a:hover{
            color: #ffffff;
        }
        .tabs .indicator {
            background-color: #f5f5f5;
        }
        .photo {
            width: auto;
            height: 80px;
            border-radius: 4px;
        }
    </style>
@endpush
