<x-core::adminindex
        title="اعلانات"
        permission="web.admin.product.product"
        chart-week-sum="{{$chartWeek->sum('count')}}"
        chart-month-sum="{{$chartMonth->sum('count')}}"
        chart-year-sum="{{$chartYear->sum('count')}}"
>

    <x-slot name="table">

        <thead>
        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
            <th class="min-w-125px">شناسه</th>
            <th class="min-w-125px">نوع اعلان</th>
            <th class="min-w-125px">کانال</th>
            <th class="min-w-125px">وضعیت</th>
            <th class="min-w-125px">تاریخ ارسال</th>
            <th class="text-end min-w-70px">عملیات</th>
        </tr>
        </thead>

        <tbody class="fw-semibold text-gray-600">
        <tr v-if="itemList.length > 0" v-for="item in itemList">
            <td>
                <p v-text="item.id" class="text-gray-800 text-hover-primary mb-1"></p>
            </td>
            <td>
                <p v-text="item.notification_type" class="text-gray-800 text-hover-primary mb-1"></p>
            </td>
            <td>
                <span
                        class="badge"
                        :class="{
                        'badge-light-primary': item.channel === 'database',
                        'badge-light-success': item.channel === 'sms',
                        'badge-light-info': item.channel === 'whatsapp',
                        'badge-light-warning': item.channel !== 'database' && item.channel !== 'sms' && item.channel !== 'whatsapp'
                    }"
                        v-text="item.channel"
                ></span>
            </td>
            <td>
                <span
                        class="badge"
                        :class="{
                        'badge-light-success': item.status === 'sent' || item.status === 'delivered',
                        'badge-light-warning': item.status === 'pending',
                        'badge-light-danger': item.status === 'failed',
                        'badge-light-primary': item.status === 'read'
                    }"
                        v-text="statusText(item.status)"
                ></span>
            </td>
            <td>
                <p v-text="toPersian(item.sent_at)" class="ltr text-start"></p>
            </td>
            <td class="text-end">
                <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    عملیات
                    <i class="ki-duotone ki-down fs-5 ms-1"></i>
                </a>
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                    <div class="menu-item px-3">
                        <a :href="currentUrl+item.id" class="menu-link px-3">نمایش</a>
                    </div>
                    <div class="menu-item px-3">
                        <a :href="currentUrl+item.id+'/edit'" class="menu-link px-3">ویرایش</a>
                    </div>
                    <div class="menu-item px-3">
                        <a href="#" class="menu-link px-3" @click.prevent="callDestroy(item)">حذف</a>
                    </div>
                </div>
            </td>
        </tr>
        <tr v-else>
            <td class="text-center table-empty-list" colspan="8" class="dt-empty">اطلاعاتی موجود نیست</td>
        </tr>
        </tbody>
    </x-slot>

    <x-slot name="filters">
        <div class="row">
            <div class="col-12 mb-7">
                <label for="categories" class="mb-2">انتخاب محصول</label>

                <div v-if="multiSelectConfigs.user && multiSelectConfigs.user.selected !== undefined">

                    <vue-multiselect
                            id="users"
                            v-model="multiSelectConfigs.user.selected"
                            :options="multiSelectConfigs.user.list"
                            @search-change="search('user', $event)"
                            :custom-label="customLabel"
                            :multiple="true"
                            :close-on-select="false"
                            track-by="id"
                            :internal-search="false"
                    >
                        <template #noResult>
                            <span>هیچ داده ای یافت نشد</span>
                        </template>
                        <template #afterList v-if="true"><p>after list</p></template>

                    </vue-multiselect>

                </div>
            </div>

            <div class="col-6 mb-7">
                <label class="fs-6 fw-semibold mb-2">نام</label>
                <input v-model="searchModel.like_first_name" type="text" class="form-control form-control-solid" placeholder="" name="name" value="" />
            </div>
            <div class="col-6 mb-7">
                <label class="fs-6 fw-semibold mb-2">نام خانوادگی</label>
                <input v-model="searchModel.like_last_name" type="text" class="form-control form-control-solid" placeholder="" name="name" value="" />
            </div>
            <div class="clearfix"></div>

            <div class="col-6 mb-7">
                <label class="fs-6 fw-semibold mb-2">موبایل</label>
                <input v-model="searchModel.like_mobile" type="text" class="form-control form-control-solid ltr" placeholder="" name="name" value="" />
            </div>
            <div class="col-6 mb-7">
                <label class="fs-6 fw-semibold mb-2">تلفن</label>
                <input v-model="searchModel.like_phone" type="text" class="form-control form-control-solid ltr" placeholder="" name="name" value="" />
            </div>
            <div class="clearfix"></div>

        </div>
    </x-slot>

    <x-slot name="scripts">
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                window.addDynamicFilter('user', 'user_id', 'core/v1/user/users');

                createWeekChart({!! $chartWeek->pluck('count') !!},{!! $chartWeek->pluck('label') !!},'.model-chart-week');
                createMonthChart({!! $chartMonth->pluck('count') !!},{!! $chartMonth->pluck('label') !!},'.model-chart-month');
                createYearChart({!! $chartYear->pluck('count') !!},{!! $chartYear->pluck('label') !!},'.model-chart-year');
            });
        </script>

    </x-slot>

</x-core::adminindex>
