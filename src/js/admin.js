if (typeof $ == "undefined") var $ = jQuery; 

const cmt = {}

cmt.init = () => {
    let hash = window.location.hash.replace('#', '')
    hash = hash.length == '' ? 'mimes' : hash
    if (hash) cmt.show(hash);
}

// cmt.loader = (width) => {
//     let timer = setTimeout(() => {
//         cmt_app.$data.loader = width
//     }, 1000);
// }

cmt.show = (page) => {
    $(`[data-content="${page}"]`).fadeIn(200).siblings().hide(0)
}

$(function () {
    cmt.init()
})

const cmt_vue = Vue.createApp({
    data() {
        return {
            loader: 10,
            mimes: [
                { name: "" },
            ]
        }
    },
    computed: {
        
    },
    methods: {
        show(page) {
            cmt.show(page)
        },
    },
    mounted() {
        console.log("Vue init");
        $("[data-loader]").animate({ width: "100%", opacity: 0 }, 2000, function () {
            $('.cmt_loader').hide(0)
        })
    },
})

const cmt_app = cmt_vue.mount("#cmt_app");