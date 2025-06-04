<x-core::adminindex title="قالب‌های اعلان" permission="web.admin.product.product" chart-week-sum="0" chart-month-sum="0" chart-year-sum="0">
    <x-slot name="table">
        <thead>
        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
            <th class="min-w-50px">شناسه</th>
            <th class="min-w-125px">عنوان</th>
            <th class="min-w-125px">کلید</th>
            <th class="min-w-125px">نوع</th>
            <th class="min-w-125px">وضعیت</th>
            <th class="text-end min-w-70px">عملیات</th>
        </tr>
        </thead>
        <tbody class="fw-semibold text-gray-600">
        <tr v-if="itemList.length > 0" v-for="item in itemList">
            <td v-text="item.id"></td>
            <td v-text="item.name"></td>
            <td v-text="item.key"></td>
            <td v-text="item.notification_type"></td>
            <td>
                <span class="badge" :class="{ 'badge-light-success': item.is_active, 'badge-light-danger': !item.is_active }">
                    @{{ item.is_active ? 'فعال' : 'غیرفعال' }}
                </span>
            </td>
            <td class="text-end">
                <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    عملیات
                    <i class="ki-duotone ki-down fs-5 ms-1"></i>
                </a>
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
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
            <td class="text-center table-empty-list" colspan="6">اطلاعاتی موجود نیست</td>
        </tr>
        </tbody>
    </x-slot>
</x-core::adminindex>
