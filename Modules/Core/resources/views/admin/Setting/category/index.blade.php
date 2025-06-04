<x-admin-index title="لیست دسته بندی تنظیمات" permission="web.admin.setting.category">

    <x-slot name="table">
        <thead class="blue-grey darken-2 white-text">
        <tr>
            <th @click="sort('orderby_id')">شناسه
                <i v-if="params.orderby_id === 'asc'" class="fa fa-sort-amount-asc" aria-hidden="true"></i>
                <i v-if="params.orderby_id === 'desc'" class="fa fa-sort-amount-desc" aria-hidden="true"></i>
            </th>
            <th @click="sort('orderby_title')">تیتر
                <i v-if="params.orderby_title === 'asc'" class="fa fa-sort-amount-asc" aria-hidden="true"></i>
                <i v-if="params.orderby_title === 'desc'" class="fa fa-sort-amount-desc" aria-hidden="true"></i>
            </th>
            <th @click="sort('orderby_settings_admin_count')">تعداد تنظیمات
                <i v-if="params.orderby_settings_admin_count === 'asc'" class="fa fa-sort-amount-asc" aria-hidden="true"></i>
                <i v-if="params.orderby_settings_admin_count === 'desc'" class="fa fa-sort-amount-desc" aria-hidden="true"></i>
            </th>
            <th @click="sort('orderby_status')">وضعیت
                <i v-if="params.orderby_status === 'asc'" class="fa fa-sort-amount-asc" aria-hidden="true"></i>
                <i v-if="params.orderby_status === 'desc'" class="fa fa-sort-amount-desc" aria-hidden="true"></i>
            </th>
            <th>عملیات</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in itemList">
            <td v-text="item.id"></td>
            <td v-text="item.title"></td>
            <td v-text="item.settings_admin_count"></td>
            <td>
                <i v-if="item.status" class="fa fa-check teal-text fa-lg" aria-hidden="true"></i>
                <i v-else class="fa fa-times red-text fa-lg" aria-hidden="true"></i>
            </td>
            <td>
                @can('settingCat_update')
                    <a :href="currentUrl+item.id+'/edit'" class="btn-floating waves-effect waves-light blue"><i class="material-icons">edit</i></a>
                @endcan
                @can('settingCat_destroy')
                    <a href="#!" @click.prevent.default="callDestroy(item)" class="btn-floating waves-effect waves-light red mr20"><i class="material-icons">delete</i></a>
                @endcan
            </td>
        </tr>
        </tbody>
    </x-slot>

</x-admin-index>
