<template>
  <div v-if="lastPage > 1" class="row align-items-center mb-4">
    <div class="col-2 d-flex align-items-center">
      <select
          name="pagination-length"
          class="form-select form-select-solid form-select-sm me-2"
          v-model="perPage"
          @change="resetPagination"
      >
        <option v-for="option in pageSizeOptions" :key="option" :value="option">{{ option }}</option>
      </select>
      <input
          type="number"
          class="form-control form-control-solid form-control-sm me-2"
          v-model="goToPage"
          @keypress.enter="goToPageHandler"
          placeholder="صفحه"
          :min="1"
          :max="lastPage"
      />
      <span v-if="loading" class="spinner-border spinner-border-sm text-primary ms-2" role="status"></span>
    </div>
    <div class="col-9 d-flex justify-content-center mt-2">
      <ul class="pagination pagination-circle pagination-outline mb-0">
        <li class="page-item first m-1" :class="{ disabled: currentPage === 1 }">
          <a class="page-link px-0" href="#" @click.prevent="changePage(1)">
            <i class="ki-duotone ki-double-right fs-2">
              <span class="path1"></span>
              <span class="path2"></span>
            </i>
          </a>
        </li>
        <li class="page-item previous m-1" :class="{ disabled: !isBackPage }">
          <a class="page-link px-0" href="#" @click.prevent="backPage">
            <i class="ki-duotone ki-right fs-2"></i>
          </a>
        </li>
        <li v-if="isBackPages" class="page-item m-1">
          <a class="page-link" href="#" @click.prevent="backPages">...</a>
        </li>
        <li v-for="value in smartPageNumbers" :key="value" class="page-item m-1" :class="{ active: isActive(value) }">
          <a class="page-link" href="#" @click.prevent="changePage(value)">{{ value }}</a>
        </li>
        <li v-if="isNextPages" class="page-item m-1">
          <a class="page-link" href="#" @click.prevent="nextPages">...</a>
        </li>
        <li class="page-item next m-1" :class="{ disabled: !isNextPage }">
          <a class="page-link px-0" href="#" @click.prevent="nextPage">
            <i class="ki-duotone ki-left fs-2"></i>
          </a>
        </li>
        <li class="page-item last m-1" :class="{ disabled: currentPage === lastPage }">
          <a class="page-link px-0" href="#" @click.prevent="changePage(lastPage)">
            <i class="ki-duotone ki-double-left fs-2">
              <span class="path1"></span>
              <span class="path2"></span>
            </i>
          </a>
        </li>
      </ul>
    </div>
    <div class="col d-flex justify-content-end">
      <span v-if="totalItems" class="text-muted">کل: {{ totalItems }}</span>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'paginate',
  props: {
    modelValue: { type: Array, default: () => [] },
    url: String,
    isReset: { type: Boolean, default: false },
    params: Object,
    pageSizeOptions: {
      type: Array,
      default: () => [10, 25, 50, 100]
    },
    maxVisiblePages: { type: Number, default: 5 }
  },
  emits: ['update:modelValue', 'responsedata'],
  data() {
    return {
      cache: [],
      instance: axios.create(),
      currentPage: 0,
      lastPage: 0,
      perPage: 15,
      startPage: 1,
      endPage: 0,
      totalItems: 0,
      loading: false,
      goToPage: ''
    };
  },
  created() {
    this.perPage = this.pageSizeOptions[0];
    this.changePage(1);
    this.endPage = this.perPage;
  },
  methods: {
    nextPages() {
      const maxPages = this.maxVisiblePages;
      const half = Math.floor(maxPages / 2);
      this.endPage = Math.min(this.lastPage, this.endPage + this.perPage);
      this.startPage = Math.max(1, this.endPage - maxPages + 1);
      if (this.endPage >= this.lastPage) {
        this.endPage = this.lastPage;
        this.startPage = Math.max(1, this.lastPage - maxPages + 1);
      }
    },
    backPages() {
      if (this.isBackPages) {
        const maxPages = this.maxVisiblePages;
        this.startPage = Math.max(1, this.startPage - this.perPage);
        this.endPage = Math.min(this.lastPage, this.startPage + maxPages - 1);
      }
    },
    nextPage() {
      if (this.isNextPage) {
        this.changePage(this.currentPage + 1);
        this.updateStartEndPages();
      }
    },
    backPage() {
      if (this.isBackPage) {
        this.changePage(this.currentPage - 1);
        this.updateStartEndPages();
      }
    },
    isActive(page) {
      return this.currentPage === page;
    },
    changePage(page) {
      const resultCache = this.isExist(page);
      if (resultCache !== undefined) {
        this.$emit('update:modelValue', resultCache.data);
        this.currentPage = page;
        this.goToPage = ''; // ریست کردن ورودی بعد از تغییر صفحه
        this.updateStartEndPages();
      } else {
        this.loading = true;
        this.giveData(this.url + '?page=' + page + '&per_page=' + this.perPage, page);
      }
    },
    giveData(url, page) {
      this.instance.get(url, { params: this.params }).then(response => {
        this.$emit('update:modelValue', response.data.data);
        this.$emit('responsedata', response.data);
        this.cache.push({ page: page, data: response.data.data });
        this.currentPage = response.data.current_page;
        this.lastPage = response.data.last_page;
        this.totalItems = response.data.total || 0;
        this.updateStartEndPages();
        this.loading = false;
        this.goToPage = ''; // ریست کردن ورودی بعد از لود
      }).catch(() => {
        this.loading = false;
      });
    },
    isExist(page) {
      return this.cache.find(obj => obj.page === page);
    },
    resetPagination() {
      this.cache = [];
      this.startPage = 1;
      this.endPage = this.perPage;
      this.changePage(1);
    },
    updateStartEndPages() {
      const maxPages = this.maxVisiblePages;
      const half = Math.floor(maxPages / 2);
      this.startPage = Math.max(1, this.currentPage - half);
      this.endPage = Math.min(this.lastPage, this.startPage + maxPages - 1);

      if (this.endPage - this.startPage + 1 < maxPages) {
        this.startPage = Math.max(1, this.endPage - maxPages + 1);
      }
      if (this.startPage > 1 && this.endPage >= this.lastPage) {
        this.startPage = Math.max(1, this.lastPage - maxPages + 1);
        this.endPage = this.lastPage;
      }
    },
    goToPageHandler() {
      const page = parseInt(this.goToPage, 10);
      if (!isNaN(page) && page >= 1 && page <= this.lastPage) {
        this.changePage(page);
      } else {
        this.goToPage = ''; // ریست کردن اگه عدد نامعتبر باشه
      }
    }
  },
  computed: {
    isNextPages() {
      return this.endPage < this.lastPage && this.lastPage > this.maxVisiblePages;
    },
    isBackPages() {
      return this.startPage > 1;
    },
    isNextPage() {
      return (this.currentPage + 1) <= this.lastPage;
    },
    isBackPage() {
      return (this.currentPage - 1) >= 1;
    },
    isEmpty() {
      return this.lastPage <= 1;
    },
    smartPageNumbers() {
      const result = [];
      for (let i = this.startPage; i <= this.endPage; i++) {
        result.push(i);
      }
      return result;
    }
  },
  watch: {
    isReset() {
      this.resetPagination();
    }
  }
};
</script>