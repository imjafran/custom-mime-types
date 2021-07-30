if (typeof $ == "undefined") var $ = jQuery;

import serialize from "./serialize";

const cmt = {};

cmt.init = () => {
  let hash = window.location.hash.replace("#", "");
  hash = hash.length == "" ? "mimes" : hash;
  if (hash) cmt.show(hash);
};

cmt.show = (page) => {
  $(`[data-content="${page}"]`).fadeIn(200).addClass('active').siblings().hide(0).removeClass('active');
  $(`[data-href="${page}"]`) 
    .addClass("active")
    .siblings()
    .removeClass("active");
};

const cmt_vue = Vue.createApp({
  data() {
    return {
      mode: "new",
      current_extention: "",
      current: {},
      loader: 10,
      per_page: 10,
      pagination: 1,
      max_pagination: -1,
      search: "",
      suggestions: {},
      roles: {},
      extentions: {},
      savedCurrent: false,
      savedCurrentTimer: false,
      max_upload_size: 0,
      savedSize: false,
      savedSizeTimer: false,
      size_units: [],
      size_unit: "mb",
      max_file_size_dropdown: false,
    };
  },
  computed: {
    error() {
      let msg = "",
        current_ext = this.current_extention.toLowerCase();

      if (
        this.mode == "new" &&
        current_ext.length > 0 &&
        Object.keys(this.extentions).length
      ) {
        Object.keys(this.extentions).forEach((ext) => {
          if (ext == current_ext || ext.split("|").includes(current_ext)) {
            msg = "Extention exists!";
          }
        });
      }

      if (this.current.roles.length == 0) {
        msg = "Select at least one role";
      }
      if (this.current.types.length == 0) {
        msg = "Mime type is required";
      }

      if (current_ext.length == 0) {
        msg = "Extention name is required";
      }

      return msg;
    },
    limit_error() {
      let upload_size = Number(
        parseInt(this.max_upload_size) *
          parseInt(this.size_units[this.size_unit])
      );
      return upload_size > _cmt.wp_max_upload_size;
    },
    getExtentions() {
      let s = this.search.trim().toLowerCase(),
        extentions = {};

      if (this.extentions) {
        Object.keys(this.extentions).forEach((ext) => {
          if (
            s.length == 0 ||
            ext.search(s) > -1 ||
            this.extentions[ext].types.search(s) > -1
          )
            extentions[ext] = this.extentions[ext];
        });
      }

      this.max_pagination = Math.ceil(
        Object.keys(extentions).length / this.per_page
      );

      let sorted_keys = Object.keys(extentions).slice(
          (this.pagination - 1) * this.per_page,
          this.pagination * this.per_page
        ),
        sorted_extentions = {};

      sorted_keys.forEach((sorted_key) => {
        sorted_extentions[sorted_key] = this.extentions[sorted_key];
      });

      return sorted_extentions;
    },
    getSuggestions() {
      let suggestions = {},
        i = 0;

      if (Object.keys(this.suggestions).length > 0) {
        Object.keys(this.suggestions).forEach((suggestion) => {
          if (!Object.keys(this.extentions).includes(suggestion) && i < 10) {
            suggestions[suggestion] = this.suggestions[suggestion];
          }
        });
      }

      return suggestions;
    },
  },
  methods: {
    show(page) {
      cmt.show(page);
    },
    toggleRole(role) {
      let index = this.current.roles.indexOf(role);
      if (index > -1) {
        if (role == "administrator") return false;
        this.current.roles.splice(index, 1);
      } else {
        this.current.roles.push(role);
      }
    },
    mime_roles(mime) {
      let roles = [];

      mime.roles.forEach((role) => {
        roles.push(this.roles[role]);
      });

      return roles.join(", ");
    },
    strip_extention() {
      let ex = this.current_extention.toLowerCase();

      ex = ex.replace(/[^a-z|0-9]/, "");

      this.current_extention = ex;
    },
    strip_types() {
      let types = this.current.types.toLowerCase();

      types = types.replace(/[^a-z/0-9|,]/, "");

      this.current.types = types;
    },
    edit(ext) {
      this.mode = "edit";
      this.current_extention = ext;
      this.current = this.extentions[ext];
      if ($("#edit_mime").length) {
        $("html, body").animate(
          {
            scrollTop: $("#edit_mime").offset().top,
          },
          1000
        );
      }
    },
    newExt() {
      this.mode = "new";
      this.current_extention = "";
      this.current = {
        types: "",
        roles: ["administrator"],
        enabled: 1,
      };
      if ($("#edit_mime").length) {
        $("html, body").animate(
          {
            scrollTop: $("#edit_mime").offset().top,
          },
          1000
        );
      }
    },
    saveCurrent() {
      clearTimeout(this.savedCurrentTimer);
      this.savedCurrent = 0;
      this.extentions[this.current_extention] = this.current;
      this.saveSettings();
      this.mode = "edit";
      this.savedCurrent = 1;
      this.savedCurrentTimer = setTimeout(() => {
        clearTimeout(this.savedCurrentTimer);
        this.savedCurrent = 0;
      }, 2000);
    },
    saveSettings() {
      let mimes = serialize(this.extentions),
        max_upload_size = Number(
          parseInt(this.max_upload_size) *
            parseInt(this.size_units[this.size_unit])
        );

      $.post(
        _cmt.ajaxurl,
        {
          mimes,
          max_upload_size,
          size_unit: this.size_unit,
          action: "cmt_save_settings",
        },
        function (res) {
          return res;
        }
      );
    },
    deleteMime(ext) {
      if (this.extentions[ext].delete) {
        //   console.log("delete 2");
        delete this.extentions[ext];
        this.saveSettings();
      } else {
        this.extentions[ext].delete = true;
        //   console.log('delete 1');
      }
    },
    size(bytes) {
      var sizes = ["Bytes", "KB", "MB", "GB", "TB"];
      if (bytes == 0) return "0 Byte";
      var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
      return Math.round(bytes / Math.pow(1024, i), 2) + " " + sizes[i];
    },
    strip_max_upload_size() {
      this.max_upload_size = this.max_upload_size.replace(/[^.0-9]/g, "");
    },
    saveSize() {
      this.savedSize = 0;
      clearTimeout(this.savedSizeTimer);
      this.saveSettings();
      this.savedSize = 1;
      this.savedSizeTimer = setTimeout(() => {
        clearTimeout(this.savedSizeTimer);
        this.savedSize = 0;
      }, 3000);
    },
  },
  created() {
    this.roles = _cmt.roles;
    this.suggestions = _cmt.suggestions;
    this.extentions = _cmt.extentions;
    this.wp_max_upload_size = _cmt.wp_max_upload_size;
    this.size_units = _cmt.size_units;
    this.size_unit = _cmt.size_unit;
    this.max_upload_size =
      parseInt(_cmt.max_upload_size) /
      parseInt(_cmt.size_units[_cmt.size_unit]);
    this.newExt();
  },
  mounted() {
    cmt.init();

    $("[data-loader]").animate(
      { width: "100%", opacity: 0 },
      2000,
      function () {
        $(".cmt_loader").hide(0);
      }
    );
  },
});

cmt_vue.mount("#cmt_app");
