if (typeof $ == "undefined") var $ = jQuery;

console.log("Demo Plugin Admin Init");

$(function () {
    console.log(_pushme);
    $.get(_pushme.ajaxurl + "?action=admin-test", function (data) {
      console.log(data);
    });
})

