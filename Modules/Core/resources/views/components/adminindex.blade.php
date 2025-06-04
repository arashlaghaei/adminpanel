@extends('core::admin.layout.master')

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0"> لیست {{$title}}</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1 mt-2">
                    <li class="breadcrumb-item text-muted">
                        <a href="#" class="text-muted text-hover-primary">خانه</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">{{$title}}</li>
                </ul>

            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="row g-5 g-xl-8">

                <div class="col-xl-4">
                    <div class="card card-xxl-stretch mb-5 mb-xl-8 theme-dark-bg-body index-card-statist">
                        <div class="card-body d-flex flex-column p-0">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <p class="text-gray-900 text-hover-primary fw-bold fs-3">{{$title}} هفت روز گذشته</p>
                                    </div>
                                    <div class="text-gray-900 fw-bold fs-3">{!! number_format($chartWeekSum ?? '0') !!}</div>
                                </div>
                            </div>

                            <div class="model-chart-week" style="height: 125px"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card card-xl-stretch mb-5 mb-xl-8 theme-dark-bg-body index-card-statist" >
                        <div class="card-body d-flex flex-column p-0">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <p class="text-gray-900 text-hover-primary fw-bold fs-3">{{$title}} سی روز گذشته</p>
                                    </div>
                                    <div class="text-gray-900 fw-bold fs-3">{!! number_format($chartMonthSum ?? '0') !!}</div>
                                </div>
                            </div>
                            <div class="model-chart-month card-rounded-bottom" data-kt-chart-color="primary" style="height: 150px"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card card-xl-stretch mb-5 mb-xl-8 theme-dark-bg-body index-card-statist" >
                        <div class="card-body d-flex flex-column p-0">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <p class="text-gray-900 text-hover-primary fw-bold fs-3">{{$title}} سال گذشته</p>
                                    </div>
                                    <div class="text-gray-900 fw-bold fs-3">{!! number_format($chartYearSum ?? '0') !!}</div>
                                </div>
                            </div>
                            <div class="model-chart-year card-rounded-bottom" data-kt-chart-color="primary" style="height: 150px"></div>
                        </div>
                    </div>
                </div>

            </div>

            <div id="app">
                <div class="card">

                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <input v-model="query" type="text" class="form-control form-control-solid w-250px ps-12" placeholder="جستجو کلی" />
                            </div>
                        </div>
                        <div class="card-toolbar">
                            <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                                @if(isset($filters))
                                    <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_for_filters">
                                        <i class="ki-duotone ki-filter fs-2"><span class="path1"></span><span class="path2"></span></i>
                                        فیلتر
                                    </button>
                                @endif

                                <a :href="currentUrl+'create'" class="btn btn-primary" >ایجاد</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body pt-0">
                        @if(isset($table))
                            <div class="table-responsive">
                                <table class="table align-middle table-hover table-row-dashed fs-6 gy-5" id="kt_customers_table">
                                    @if(isset($table))
                                        {{$table}}
                                    @endif
                                </table>
                            </div>
                        @endif

                        <div class="row">
                            <paginate
                                    v-if="itemList"
                                    v-model="itemList"
                                    :is-reset="reset"
                                    :url="currentUrl"
                                    :params="params"
                                    :page-size-options="[10, 20, 30, 50]"
                                    :max-visible-pages="8"
                                    @responsedata="responsedata = $event"
                            ></paginate>
                        </div>
                    </div>

                </div>

                @if(isset($filters))
                    <div class="modal fade" id="kt_modal_for_filters" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered mw-1000px">
                            <div class="modal-content">
                                <form class="form" action="#" id="kt_modal_add_customer_form" data-kt-redirect="apps/customers/list.html">
                                    <div class="modal-header" id="kt_modal_add_customer_header">
                                        <h2 class="fw-bold">فیلتر ها</h2>
                                        <div id="kt_modal_add_customer_close" class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                                            <i class="ki-duotone ki-cross fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                    </div>
                                    <div class="modal-body py-10 px-lg-17">
                                        <div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
                                            {{$filters}}
                                        </div>
                                    </div>
                                    <div class="modal-footer flex-center">
                                        <button type="reset" id="kt_modal_add_customer_cancel" class="btn btn-light me-3" data-bs-dismiss="modal">لغو</button>
                                        <div @click="getSearch" type="submit" id="kt_modal_add_customer_submit" class="btn btn-primary" data-bs-dismiss="modal">
                                            <span class="indicator-label">جستجو</span>
                                            <span class="indicator-progress">لطفا صبر کنید...<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="modal fade" tabindex="-1" id="kt_modal_1">
                    <div class="modal-dialog mw-800px">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">آیا مایل به حذف هستید؟</h3>
                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                </div>
                            </div>

                            <div class="modal-body">
                                <div class="d-flex flex-stack gap-5 mb-3">
                                    <button type="button" class="btn btn-light-primary w-100" data-kt-modal-bidding="option">شناسه</button>
                                    <button v-text="modal.id" type="button" class="btn btn-light-primary w-100" data-kt-modal-bidding="option"></button>
                                </div>
                                <div class="d-flex flex-stack gap-5 mb-3">
                                    <button type="button" class="btn btn-light-primary w-100" data-kt-modal-bidding="option">مشخصات</button>
                                    <button v-text="modal.title" type="button" class="btn btn-light-primary w-100" data-kt-modal-bidding="option"></button>
                                </div>

                            </div>

                            <div class="modal-footer flex-center">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">لغو</button>
                                <button @click.prevent="Destroy()" type="button" class="btn btn-primary">تایید</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset('assets/panel/js/vue3.js')}}"></script>
    <script src="{{asset('assets/panel/plugins/axios/axios.js')}}"></script>
    <script src="{{ asset('assets/panel/plugins/npaginate/paginate.js') }}"></script>
    <script src="{{asset('assets/panel/plugins/multiselect/multiselect.js')}}"></script>
    <script src="{{asset('assets/panel/plugins/moment-jalali/moment-jalali3-3.js')}}"></script>


    <script>
        var baseUrl = '/api';

        let vueApp = null; // نگه داشتن اپلیکیشن Vue برای دسترسی جهانی

        document.addEventListener('DOMContentLoaded', () => {
            const { createApp } = Vue;

            vueApp = createApp({
                data() {
                    return {
                        currentUrl: window.location.pathname + '/',
                        instance: axios.create({ baseURL: window.location.pathname }),
                        ax: axios.create({
                            baseURL: window.baseUrl,
                            headers: { 'Authorization': 'Bearer {{ auth()->user()->api_token ?? "QmJdrHq3sMuWUJURsI0e89FV6Q0hH4BNQNtNgKhed09eea98" }}' }
                        }),
                        itemList: [],
                        responsedata: {},
                        reset: false,
                        params: {},
                        query: '',
                        // modal: { destroy: false },
                        modal: {
                            mode: 'create',
                            id: '',
                            title: '',
                            body: '',
                            destroy: []
                        },
                        searchModel: {
                            date_start: '',
                            date_end: ''
                        },
                        multiSelectConfigs: Vue.reactive({}),
                    };
                },
                mounted() {
                    this.$nextTick(() => {
                        KTMenu.createInstances();
                    });
                },
                methods: {
                    addDynamicFilter(name, elementName, url) {
                        // اضافه کردن فیلتر داینامیک به multiSelectConfigs
                        this.multiSelectConfigs[name] = Vue.reactive({
                            url: url || '',
                            list: [],
                            selected: [],
                            query: '',
                            params: {},
                            data: [],
                            loading: false,
                            elementName: elementName || ''
                        });
                    },
                    getSearch() {
                        for (const item in this.searchModel) {
                            if (this.searchModel[item] === '' || this.searchModel[item] === undefined) {
                                delete this.searchModel[item];
                            }
                        }
                        this.params = JSON.parse(JSON.stringify(this.searchModel));
                        for (const element in this.multiSelectConfigs) {
                            const selected = this.multiSelectConfigs[element]['selected'];
                            if (selected) {
                                const elementId = this.multiSelectConfigs[element]['elementName'];
                                if (Array.isArray(selected)) {
                                    const ids = selected.map(item => item.id).filter(id => id !== undefined);
                                    if (ids.length > 0) {
                                        this.params[elementId] = ids;
                                    }
                                } else if (selected.id) {
                                    this.params[elementId] = selected.id;
                                }
                            }
                        }
                        this.reset = !this.reset;
                    },
                    getExcel() {
                        for (const item in this.searchModel) {
                            if (this.searchModel[item] === '' || this.searchModel[item] === undefined) {
                                delete this.searchModel[item];
                            }
                        }
                        this.params = JSON.parse(JSON.stringify(this.searchModel));
                        for (const element in this.multiSelectConfigs) {
                            const selected = this.multiSelectConfigs[element]['selected'];
                            if (selected) {
                                const elementId = this.multiSelectConfigs[element]['elementName'];
                                if (Array.isArray(selected)) {
                                    const ids = selected.map(item => item.id).filter(id => id !== undefined);
                                    if (ids.length > 0) {
                                        this.params[elementId] = ids;
                                    }
                                } else if (selected.id) {
                                    this.params[elementId] = selected.id;
                                }
                            }
                        }
                        let queryString = '';
                        for (const key in this.params) {
                            if (Array.isArray(this.params[key])) {
                                this.params[key].forEach(value => {
                                    queryString += `${encodeURIComponent(key)}[]=${encodeURIComponent(value)}&`;
                                });
                            } else {
                                queryString += `${encodeURIComponent(key)}=${encodeURIComponent(this.params[key])}&`;
                            }
                        }
                        queryString = queryString.slice(0, -1);
                        const url = `${this.currentUrl}excel?${queryString}`;
                        window.location.href = url;
                    },
                    sort(query) {
                        this.reset = !this.reset;
                        if (this.changeSort(this.params[query]) === '') {
                            delete this.params[query];
                        } else {
                            this.params[query] = this.changeSort(this.params[query]);
                        }
                    },
                    changeSort(value) {
                        if (value === '' || value === undefined) return 'asc';
                        if (value === 'asc') return 'desc';
                        return '';
                    },
                    callDestroy(item) {
                        this.modal.id = item.id;
                        this.modal.title = item.title || item.name || (item.first_name ? `${item.first_name} - ${item.last_name}` : 'ثبت نشده');
                        this.modal.destroy = true;
                        const modalElement = document.getElementById('kt_modal_1');
                        const modal = new bootstrap.Modal(modalElement);
                        modal.show();
                    },
                    Destroy() {
                        const id = this.modal.id;
                        const modalElement = document.getElementById('kt_modal_1');
                        const modal = bootstrap.Modal.getInstance(modalElement); // مودال فعلی رو می‌گیره

                        this.instance.delete('/' + id).then(response => {
                            if (response.data.status === false) {
                                this.modal.destroy = false;
                                Swal.fire({
                                    text: "عملیات ناموفق لطفا بعدا تلاش کنید.",
                                    buttonsStyling: false,
                                    icon: 'success',
                                    confirmButtonText: 'باشه',
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                });
                            } else {
                                this.reset = !this.reset;
                                this.modal.destroy = false;
                                Swal.fire({
                                    text: "آیتم مورد نظر حذف شد.",
                                    buttonsStyling: false,
                                    icon: 'success',
                                    confirmButtonText: 'باشه',
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                });
                            }
                        });
                        modal.hide();
                    },
                    toPersian(input, format = 'jYYYY/jMM/jDD HH:mm:ss') {
                        if (input && window.moment) {
                            return window.moment(input, 'YYYY/MM/DD HH:mm:ss').format(format);
                        }
                        return 'ثبت نشده';
                    },
                    numberFormat(value) {
                        return new Intl.NumberFormat().format(value);
                    },
                    search(field, query) {
                        const config = this.multiSelectConfigs[field];
                        if (config) {
                            config.params.query = query;
                            config.loading = true;
                            this.ax.get(config.url, { params: config.params }).then(response => {
                                config.list = response.data.data || [];
                                config.data = response.data || { current_page: 1, last_page: 1 }; // مقدار پیش‌فرض
                                config.loading = false;
                                console.log('Search results for', field, ':', config.data);
                            }).catch(() => {
                                config.loading = false;
                            });
                        }
                    },
                    customLabel(element) {
                        if (element.title) return element.id + ' - ' + element.title;
                        if (element.first_name) return element.id + ' - ' + element.first_name + ' - ' + element.last_name;
                        return element.id + ' - ' + element.name;
                    },
                    userLabel(element) {
                        return element.id + ' - ' + element.first_name + ' - ' + element.last_name;
                    },
                    isMoreResult(field) {
                        const config = this.multiSelectConfigs[field];
                        if (!config || !config.data) {
                            console.log('Config or data is undefined for field:', field);
                            return false;
                        }
                        console.log('isMoreResult for', field, ':', config.data.current_page, config.data.last_page);
                        return config.data.current_page + 1 <= config.data.last_page;
                    },
                    moreResult(field) {
                        const config = this.multiSelectConfigs[field];
                        if (config && this.isMoreResult(field)) {
                            config.loading = true;
                            config.params.page = (config.data.current_page || 1) + 1; // مقدار پیش‌فرض برای current_page
                            this.ax.get(config.url, { params: config.params }).then(response => {
                                config.list = config.list.concat(response.data.data || []);
                                config.data = response.data;
                                config.loading = false;
                            }).catch(() => {
                                config.loading = false;
                            });
                        }
                    },
                    statusText(status) {
                        const statusMap = {
                            sent: 'ارسال شده',
                            pending: 'در انتظار',
                            failed: 'ناموفق',
                            delivered: 'تحویل داده شده',
                            read: 'خوانده شده'
                        };
                        return statusMap[status] || 'ناشناخته';
                    }
                },
                computed: {
                    isEdit() {
                        return this.model.mode === 'edit';
                    },
                    isDestroy() {
                        return this.model.mode === 'destroy';
                    }
                },
                watch: {
                    query(newVal) {
                        this.params.query = newVal;
                        this.reset = !this.reset;
                    },
                    itemList() {
                        this.$nextTick(() => {
                            KTMenu.createInstances();
                        });
                    }
                },
            });

            vueApp.component('vue-multiselect', window.VueMultiselect.default);
            vueApp.component('paginate', window.Paginate);

            window.addDynamicFilter = (name, elementName, url) => {
                if (vueApp) {
                    vueApp._instance.proxy.addDynamicFilter(name, elementName, url);
                }
            };

            vueApp.mount('#app');
            KTMenu.createInstances();

        });

        const title = "{{$title}}";

        const createWeekChart = function (data, category, className) {
            var charts = document.querySelectorAll(className);
            var options;
            var chart;
            var height;

            [].slice.call(charts).map(function (element) {
                height = parseInt(KTUtil.css(element, 'height')) || 300; // مقدار پیش‌فرض 300 اگر height تعریف نشده

                var labelColor = KTUtil.getCssVariableValue('--bs-gray-800');

                options = {
                    series: [{
                        name: 'تعداد',
                        data: data
                    }],
                    chart: {
                        fontFamily: 'inherit',
                        height: height,
                        width: '100%', // یا یه مقدار ثابت مثل 800
                        type: 'bar',
                        toolbar: {
                            show: false
                        }
                    },
                    grid: {
                        show: false,
                        padding: {
                            top: 0,
                            bottom: 0,
                            left: 0,
                            right: 0
                        }
                    },
                    colors: ['#ffffff'],
                    plotOptions: {
                        bar: {
                            borderRadius: 2.5,
                            dataLabels: {
                                position: 'top',
                            },
                            columnWidth: '10%'
                        }
                    },
                    dataLabels: {
                        enabled: false,
                        formatter: function (val) {
                            return val;
                        },
                        offsetY: -20,
                        style: {
                            fontSize: '10px',
                            colors: ["#304758"]
                        }
                    },
                    xaxis: {
                        labels: {
                            show: false,
                            style: {
                                colors: '#304758',
                                fontSize: '10px'
                            },
                            rotate: -45,
                            hideOverlappingLabels: false
                        },
                        categories: category,
                        position: 'top',
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        },
                        crosshairs: {
                            show: false
                        },
                        tooltip: {
                            enabled: false
                        }
                    },
                    yaxis: {
                        show: false,
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        },
                        labels: {
                            show: false,
                            formatter: function (val) {
                                return val;
                            }
                        }
                    }
                };

                chart = new ApexCharts(element, options);
                chart.render();
            });
        };
        const createMonthChart = function (data, category, className) {
            var charts = document.querySelectorAll(className);

            [].slice.call(charts).map(function (element) {
                var height = parseInt(KTUtil.css(element, 'height'));

                if (!element) {
                    return;
                }

                var color = element.getAttribute('data-kt-chart-color');
                var labelColor = KTUtil.getCssVariableValue('--bs-' + 'gray-800');
                var strokeColor = KTUtil.getCssVariableValue('--bs-' + 'gray-300');
                var baseColor = KTUtil.getCssVariableValue('--bs-' + color);

                var mode = KTThemeMode.getMode();
                let lightColor;
                if (mode == 'dark') {
                    lightColor = KTUtil.getCssVariableValue('--bs-' + color + '-light');
                } else {
                    lightColor = "transparent";
                }

                var options = {
                    series: [{
                        name: title,
                        data: data
                    }],
                    chart: {
                        fontFamily: 'inherit',
                        type: 'area',
                        height: height,
                        toolbar: {
                            show: false
                        },
                        zoom: {
                            enabled: false
                        },
                        sparkline: {
                            enabled: true
                        }
                    },
                    plotOptions: {},
                    legend: {
                        show: false
                    },
                    dataLabels: {
                        enabled: false
                    },
                    fill: {
                        type: 'solid',
                        opacity: 1
                    },
                    stroke: {
                        curve: 'smooth',
                        show: true,
                        width: 3,
                        colors: ['#FFFFFF']
                    },
                    xaxis: {
                        categories: category,
                        axisBorder: {
                            show: false,
                        },
                        axisTicks: {
                            show: false
                        },
                        labels: {
                            show: false,
                            style: {
                                colors: labelColor,
                                fontSize: '12px'
                            }
                        },
                        crosshairs: {
                            show: false,
                            position: 'front',
                            stroke: {
                                color: strokeColor,
                                width: 1,
                                dashArray: 3
                            }
                        },
                        tooltip: {
                            enabled: true,
                            formatter: undefined,
                            offsetY: 0,
                            style: {
                                fontSize: '12px'
                            },
                        }
                    },
                    yaxis: {
                        // min: 0,
                        // max: 100,
                        labels: {
                            show: false,
                            style: {
                                colors: labelColor,
                                fontSize: '12px'
                            }
                        }
                    },
                    states: {
                        normal: {
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        },
                        hover: {
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        },
                        active: {
                            allowMultipleDataPointsSelection: false,
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        }
                    },
                    labels: category,

                    tooltip: {
                        style: {
                            fontSize: '12px'
                        },
                        y: {
                            formatter: function (val) {
                                return val + " عدد "
                            }
                        },
                        x: {
                            formatter: function (val, opts) {
                                return options.labels?.[opts.dataPointIndex] || 'نامشخص';
                            }

                        },
                    },
                    colors: [lightColor],
                    markers: {
                        colors: [lightColor],
                        strokeColor: [baseColor],
                        strokeWidth: 3
                    }
                };

                var chart = new ApexCharts(element, options);
                chart.render();
            });
        };
        const createYearChart = function (data, category, className) {
            var charts = document.querySelectorAll(className);

            [].slice.call(charts).map(function (element) {
                var height = parseInt(KTUtil.css(element, 'height'));

                if (!element) {
                    return;
                }

                var color = element.getAttribute('data-kt-chart-color');
                var labelColor = KTUtil.getCssVariableValue('--bs-' + 'gray-800');
                var strokeColor = KTUtil.getCssVariableValue('--bs-' + 'gray-300');
                var baseColor = KTUtil.getCssVariableValue('--bs-' + color);

                var mode = KTThemeMode.getMode();
                let lightColor;
                if (mode == 'dark') {
                    lightColor = KTUtil.getCssVariableValue('--bs-' + color + '-light');
                } else {
                    lightColor = "transparent";
                }

                var options = {
                    series: [{
                        name: title,
                        data: data
                    }],
                    chart: {
                        fontFamily: 'inherit',
                        type: 'area',
                        height: height,
                        toolbar: {
                            show: false
                        },
                        zoom: {
                            enabled: false
                        },
                        sparkline: {
                            enabled: true
                        }
                    },
                    plotOptions: {},
                    legend: {
                        show: false
                    },
                    dataLabels: {
                        enabled: false
                    },
                    fill: {
                        type: 'solid',
                        opacity: 1
                    },
                    stroke: {
                        curve: 'smooth',
                        show: true,
                        width: 3,
                        colors: ['#FFFFFF']
                    },
                    xaxis: {
                        categories: category,
                        axisBorder: {
                            show: false,
                        },
                        axisTicks: {
                            show: false
                        },
                        labels: {
                            show: false,
                            style: {
                                colors: labelColor,
                                fontSize: '12px'
                            }
                        },
                        crosshairs: {
                            show: false,
                            position: 'front',
                            stroke: {
                                color: strokeColor,
                                width: 1,
                                dashArray: 3
                            }
                        },
                        tooltip: {
                            enabled: true,
                            formatter: undefined,
                            offsetY: 0,
                            style: {
                                fontSize: '12px'
                            }
                        }
                    },
                    yaxis: {
                        // min: 0,
                        // max: 100,
                        labels: {
                            show: false,
                            style: {
                                colors: labelColor,
                                fontSize: '12px'
                            }
                        }
                    },
                    states: {
                        normal: {
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        },
                        hover: {
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        },
                        active: {
                            allowMultipleDataPointsSelection: false,
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        }
                    },
                    tooltip: {
                        style: {
                            fontSize: '12px'
                        },
                        y: {
                            formatter: function (val) {
                                return val + " عدد "
                            }
                        },

                    },
                    colors: [lightColor],
                    markers: {
                        colors: [lightColor],
                        strokeColor: [baseColor],
                        strokeWidth: 3
                    }
                };

                var chart = new ApexCharts(element, options);
                chart.render();
            });
        };

    </script>


    @if(isset($scripts))
        {{$scripts}}
    @endif

@endpush

@push('styles')
    <link rel="stylesheet" href="{{asset('assets/panel/plugins/multiselect/multiselect.css')}}">


    @if(isset($styles))
        {{$styles}}
    @endif

@endpush