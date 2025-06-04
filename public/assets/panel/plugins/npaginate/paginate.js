(function(global, factory) {
  typeof exports === "object" && typeof module !== "undefined" ? module.exports = factory(require("axios"), require("vue")) : typeof define === "function" && define.amd ? define(["axios", "vue"], factory) : (global = typeof globalThis !== "undefined" ? globalThis : global || self, global.Paginate = factory(global.axios, global.Vue));
})(this, function(axios, vue) {
  "use strict";
  const _export_sfc = (sfc, props) => {
    const target = sfc.__vccOpts || sfc;
    for (const [key, val] of props) {
      target[key] = val;
    }
    return target;
  };
  const _sfc_main = {
    name: "paginate",
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
    emits: ["update:modelValue", "responsedata"],
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
        goToPage: ""
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
        if (resultCache !== void 0) {
          this.$emit("update:modelValue", resultCache.data);
          this.currentPage = page;
          this.goToPage = "";
          this.updateStartEndPages();
        } else {
          this.loading = true;
          this.giveData(this.url + "?page=" + page + "&per_page=" + this.perPage, page);
        }
      },
      giveData(url, page) {
        this.instance.get(url, { params: this.params }).then((response) => {
          this.$emit("update:modelValue", response.data.data);
          this.$emit("responsedata", response.data);
          this.cache.push({ page, data: response.data.data });
          this.currentPage = response.data.current_page;
          this.lastPage = response.data.last_page;
          this.totalItems = response.data.total || 0;
          this.updateStartEndPages();
          this.loading = false;
          this.goToPage = "";
        }).catch(() => {
          this.loading = false;
        });
      },
      isExist(page) {
        return this.cache.find((obj) => obj.page === page);
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
          this.goToPage = "";
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
        return this.currentPage + 1 <= this.lastPage;
      },
      isBackPage() {
        return this.currentPage - 1 >= 1;
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
  const _hoisted_1 = {
    key: 0,
    class: "row align-items-center mb-4"
  };
  const _hoisted_2 = { class: "col-2 d-flex align-items-center" };
  const _hoisted_3 = ["value"];
  const _hoisted_4 = ["max"];
  const _hoisted_5 = {
    key: 0,
    class: "spinner-border spinner-border-sm text-primary ms-2",
    role: "status"
  };
  const _hoisted_6 = { class: "col-9 d-flex justify-content-center mt-2" };
  const _hoisted_7 = { class: "pagination pagination-circle pagination-outline mb-0" };
  const _hoisted_8 = {
    key: 0,
    class: "page-item m-1"
  };
  const _hoisted_9 = ["onClick"];
  const _hoisted_10 = {
    key: 1,
    class: "page-item m-1"
  };
  const _hoisted_11 = { class: "col d-flex justify-content-end" };
  const _hoisted_12 = {
    key: 0,
    class: "text-muted"
  };
  function _sfc_render(_ctx, _cache, $props, $setup, $data, $options) {
    return $data.lastPage > 1 ? (vue.openBlock(), vue.createElementBlock("div", _hoisted_1, [
      vue.createElementVNode("div", _hoisted_2, [
        vue.withDirectives(vue.createElementVNode("select", {
          name: "pagination-length",
          class: "form-select form-select-solid form-select-sm me-2",
          "onUpdate:modelValue": _cache[0] || (_cache[0] = ($event) => $data.perPage = $event),
          onChange: _cache[1] || (_cache[1] = (...args) => $options.resetPagination && $options.resetPagination(...args))
        }, [
          (vue.openBlock(true), vue.createElementBlock(vue.Fragment, null, vue.renderList($props.pageSizeOptions, (option) => {
            return vue.openBlock(), vue.createElementBlock("option", {
              key: option,
              value: option
            }, vue.toDisplayString(option), 9, _hoisted_3);
          }), 128))
        ], 544), [
          [vue.vModelSelect, $data.perPage]
        ]),
        vue.withDirectives(vue.createElementVNode("input", {
          type: "number",
          class: "form-control form-control-solid form-control-sm me-2",
          "onUpdate:modelValue": _cache[2] || (_cache[2] = ($event) => $data.goToPage = $event),
          onKeypress: _cache[3] || (_cache[3] = vue.withKeys((...args) => $options.goToPageHandler && $options.goToPageHandler(...args), ["enter"])),
          placeholder: "صفحه",
          min: 1,
          max: $data.lastPage
        }, null, 40, _hoisted_4), [
          [vue.vModelText, $data.goToPage]
        ]),
        $data.loading ? (vue.openBlock(), vue.createElementBlock("span", _hoisted_5)) : vue.createCommentVNode("", true)
      ]),
      vue.createElementVNode("div", _hoisted_6, [
        vue.createElementVNode("ul", _hoisted_7, [
          vue.createElementVNode("li", {
            class: vue.normalizeClass(["page-item first m-1", { disabled: $data.currentPage === 1 }])
          }, [
            vue.createElementVNode("a", {
              class: "page-link px-0",
              href: "#",
              onClick: _cache[4] || (_cache[4] = vue.withModifiers(($event) => $options.changePage(1), ["prevent"]))
            }, _cache[10] || (_cache[10] = [
              vue.createElementVNode("i", { class: "ki-duotone ki-double-right fs-2" }, [
                vue.createElementVNode("span", { class: "path1" }),
                vue.createElementVNode("span", { class: "path2" })
              ], -1)
            ]))
          ], 2),
          vue.createElementVNode("li", {
            class: vue.normalizeClass(["page-item previous m-1", { disabled: !$options.isBackPage }])
          }, [
            vue.createElementVNode("a", {
              class: "page-link px-0",
              href: "#",
              onClick: _cache[5] || (_cache[5] = vue.withModifiers((...args) => $options.backPage && $options.backPage(...args), ["prevent"]))
            }, _cache[11] || (_cache[11] = [
              vue.createElementVNode("i", { class: "ki-duotone ki-right fs-2" }, null, -1)
            ]))
          ], 2),
          $options.isBackPages ? (vue.openBlock(), vue.createElementBlock("li", _hoisted_8, [
            vue.createElementVNode("a", {
              class: "page-link",
              href: "#",
              onClick: _cache[6] || (_cache[6] = vue.withModifiers((...args) => $options.backPages && $options.backPages(...args), ["prevent"]))
            }, "...")
          ])) : vue.createCommentVNode("", true),
          (vue.openBlock(true), vue.createElementBlock(vue.Fragment, null, vue.renderList($options.smartPageNumbers, (value) => {
            return vue.openBlock(), vue.createElementBlock("li", {
              key: value,
              class: vue.normalizeClass(["page-item m-1", { active: $options.isActive(value) }])
            }, [
              vue.createElementVNode("a", {
                class: "page-link",
                href: "#",
                onClick: vue.withModifiers(($event) => $options.changePage(value), ["prevent"])
              }, vue.toDisplayString(value), 9, _hoisted_9)
            ], 2);
          }), 128)),
          $options.isNextPages ? (vue.openBlock(), vue.createElementBlock("li", _hoisted_10, [
            vue.createElementVNode("a", {
              class: "page-link",
              href: "#",
              onClick: _cache[7] || (_cache[7] = vue.withModifiers((...args) => $options.nextPages && $options.nextPages(...args), ["prevent"]))
            }, "...")
          ])) : vue.createCommentVNode("", true),
          vue.createElementVNode("li", {
            class: vue.normalizeClass(["page-item next m-1", { disabled: !$options.isNextPage }])
          }, [
            vue.createElementVNode("a", {
              class: "page-link px-0",
              href: "#",
              onClick: _cache[8] || (_cache[8] = vue.withModifiers((...args) => $options.nextPage && $options.nextPage(...args), ["prevent"]))
            }, _cache[12] || (_cache[12] = [
              vue.createElementVNode("i", { class: "ki-duotone ki-left fs-2" }, null, -1)
            ]))
          ], 2),
          vue.createElementVNode("li", {
            class: vue.normalizeClass(["page-item last m-1", { disabled: $data.currentPage === $data.lastPage }])
          }, [
            vue.createElementVNode("a", {
              class: "page-link px-0",
              href: "#",
              onClick: _cache[9] || (_cache[9] = vue.withModifiers(($event) => $options.changePage($data.lastPage), ["prevent"]))
            }, _cache[13] || (_cache[13] = [
              vue.createElementVNode("i", { class: "ki-duotone ki-double-left fs-2" }, [
                vue.createElementVNode("span", { class: "path1" }),
                vue.createElementVNode("span", { class: "path2" })
              ], -1)
            ]))
          ], 2)
        ])
      ]),
      vue.createElementVNode("div", _hoisted_11, [
        $data.totalItems ? (vue.openBlock(), vue.createElementBlock("span", _hoisted_12, "کل: " + vue.toDisplayString($data.totalItems), 1)) : vue.createCommentVNode("", true)
      ])
    ])) : vue.createCommentVNode("", true);
  }
  const Paginate = /* @__PURE__ */ _export_sfc(_sfc_main, [["render", _sfc_render]]);
  return Paginate;
});
