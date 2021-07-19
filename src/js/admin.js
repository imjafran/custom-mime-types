if (typeof $ == "undefined") var $ = jQuery;

console.log("Demo Plugin Admin Init");

$(function () {
    console.log(pushme_options);
    $.get(pushme_options.ajaxurl + '?action=test', function (data) {
        console.log(data);
    })
})

