@extends('core::admin.layout.master')

@section('content')

    <x-core::form.page-header resource="کاربر" page="ویرایش" />

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <form class="form d-flex flex-column flex-lg-row" method="post" action="{{route(getNamePage('update'),$user->id)}}"  enctype="multipart/form-data" >
                {{ method_field('PUT') }}
                {{ csrf_field() }}

                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>ویرایش کاربر</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">

                            <div class="row">

                                <div class="col-6">
                                    <x-core::form.input name="username" title="نام کاربری" class="dleft" value="{{$user->username}}"/>
                                </div>
                                <div class="col-6">
                                    <x-core::form.input name="email" title="ایمیل" class="dleft" value="{{$user->email}}"/>
                                </div>
                                <div class="clearfix mb-7"></div>

                                <div class="col-6">
                                    <x-core::form.input name="first_name" title="نام" value="{{$user->first_name}}"/>
                                </div>
                                <div class="col-6">
                                    <x-core::form.input name="last_name" title="نام خانوادگی" value="{{$user->last_name}}"/>
                                </div>
                                <div class="clearfix mb-7"></div>

                                <div class="col-6">
                                    <x-core::form.input name="mobile" title="موبایل" class="dleft" value="{{$user->mobile}}"/>
                                </div>
                                <div class="col-6">
                                    <x-core::form.input name="phone" title="تلفن ثابت" class="dleft" value="{{$user->phone}}"/>
                                </div>
                                <div class="clearfix mb-7"></div>

                                <div class="col-6">
                                    <x-core::form.date-picker
                                            title="تاریخ تولد"
                                            name="birth_date"
                                            required="true"
                                            value="{{ old('birth_date',toPersian($user->birth_date)) }}"
                                            class="custom-class"
                                    />
                                </div>
                                <div class="col-6">
                                    <x-core::form.input title="محل تولد" name="birth_place" value="{{$user->birth_place}}" />
                                </div>
                                <div class="clearfix mb-7"></div>

                                <div class="col-12 ">
                                    <x-core::form.input name="address" title="آدرس" value="{{$user->address}}"/>
                                </div>
                                <div class="clearfix mb-7"></div>

                                <div class="col-12 ">
                                    <x-core::form.input name="password" title="تغییر گذرواژه"  class="dleft"/>
                                </div>
                                <div class="clearfix mb-7"></div>

                                <div class="col-4">
                                    <x-core::form.select
                                            name="gender"
                                            title="جنسیت"
                                            :options="[
                                                'male' => 'مرد',
                                                'female' => 'زن',
                                                'other' => 'موارد دیگر',
                                            ]"
                                            value="{{old('gender', $user->gender)}}"
                                    />
                                </div>
                                <div class="col-4">
                                    <x-core::form.select
                                            name="type"
                                            title="نوع کاربر"
                                            :options="[
                                            'admin' => 'مدیر',
                                            'user' => 'کاربر',
                                        ]"
                                            value="{{old('type', $user->type)}}"
                                    />
                                </div>
                                <div class="col-4">
                                    <x-core::form.select
                                            name="status"
                                            title="وضعیت کاربر"
                                            :options="[
                                            'active' => 'فعال',
                                            'inactive' => 'غیرفعال',
                                            'pending' => 'در انتظار تأیید',
                                            'banned' => 'مسدود شده'
                                        ]"
                                            value="{{old('status', $user->status)}}"
                                    />
                                </div>
                                <div class="clearfix mb-7"></div>

                                <div class="col-6">
                                    <x-core::form.image-upload
                                            title="آپلود تصویر محصول"
                                            name="picture"
                                            image="{{ old('picture', $user->picture ? asset($user->picture):'') }}"
                                    />
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="d-flex justify-content-start">
                        <a href="{{route(getNamePage('index'))}}" class="btn btn-light me-5">انصراف</a>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">ذخیره تغییرات</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection