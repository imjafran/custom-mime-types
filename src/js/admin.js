 

if (typeof $ == "undefined") var $ = jQuery;

export const pushme = {};

pushme.show = (target = "dashboard") => {
  $(".pushme-contents")
    .find(`[data-content="${target}"]`)
    .fadeIn(200)
    .siblings()
    .hide(0);
};

$(document).on("click", ".pushme-nav a", function (e) {
  $(".pushme-nav a").removeClass("active");
  $(this).removeClass("active");
  let target = $(this).attr("href").replace("#/", "");
  pushme.show(target);
});

window.addEventListener("DOMContentLoaded", function () {
  // show section
  let target = window.location.hash.replace("#/", "");
  pushme.show(target.length ? target : "projects");
});

export const pushme_vue = Vue.createApp({
  data() {
    return {
      projects: {
        items: [],
        offset: 0,
      },
    };
  },
  computed: {},
  methods: {
    loadProjects(offset = 0) {
      let self = this;
      $.get(
        `${pushme_options.ajaxurl}?action=pushme_projects&offset=0`,
        function (data) {
          self.projects.items = data;
        }
      );
    },
    update_project(project) {
      let self = this;
      console.log(project);
      $.post(
        `${pushme_options.ajaxurl}?action=pushme_project`,
        project,
        function (data) {
          console.log(data);
          self.loadProjects();
        }
      );
    },
  },
  created() {
      this.loadProjects();
      console.log("Loaded");
  },
  mounted() {},
});

export const pushme_app = pushme_vue.mount("#pushme-admin");
