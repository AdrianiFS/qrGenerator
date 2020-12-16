/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");
window.Vue = require("vue");

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
});




// let qrBtn = select(".qrBtn");
// qrBtn.addEventListener("click", (e) => {
//     e.preventDefault();
//     let qrInput = select(".qrInput");
//     let qrImg = select(".qrImg");
// let qrcode=document.getElementById('qrcode')
//     let options = {
//         text:qrInput.value, 
//         width: 256,
//         height: 256,
//         colorDark: "#000000",
//         colorLight: "#ffffff",
//         correctLevel: QRCode.CorrectLevel.H, // L, M, Q, H
//         dotScale: 1,
//     };
//     qrImg.src = new QRCode(qrcode, options);
// });
// function select(el) {
//     return document.querySelector(el);
// }



// let addUrlBtn= qSelector('.addUrlBtn')
// addUrlBtn.addEventListener('click',()=>{
//     let createResourceForm = qSelector('.createResourceForm');
//     createResourceForm.classList.add('activeForm');
// })
// let deleteCreateResourceForm= qSelector('.deleteCreateResourceForm');
// deleteCreateResourceForm.addEventListener('click', (e)=>{
//     e.preventDefault();
//     let generatedUrl= qSelector('.generatedUrl');
//     let redirectionUrl= qSelector('.redirectionUrl');
//     generatedUrl.value='';
//     redirectionUrl.value='';
// })
// let saveCreateResourceForm= qSelector('.saveCreateResourceForm');
// saveCreateResourceForm.addEventListener('click', ()=>{
//     // e.preventDefault();
//     let createResourceForm = qSelector('.createResourceForm');
//     createResourceForm.style.display='none';
// console.log('this');
// })

// function qSelector (param){
//   return  document.querySelector(param);
// }