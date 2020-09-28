/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('./users');

require('./jquery.jTinder'); 

require('./jquery.transform2d'); 

require('./jTinder'); 

require('./chat');

// window.Vue = require('vue');


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
// });


$(function(){
  var imgHeight = $('.js-mainVisual').outerHeight(); //画像の高さを取得。これがイベント発火位置になる。
  var header = $('.js-header'); //ヘッダーコンテンツ

  $(window).on('load scroll', function(){
     if ($(window).scrollTop() < header) {
       //メインビジュアル内にいるので、クラスを外す。
       header.removeClass('headerColor-default');
     }else {
       //メインビジュアルより下までスクロールしたので、クラスを付けて色を変える
       header.addClass('headerColor-default');
     }
  });
});
