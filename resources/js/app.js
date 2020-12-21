/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

require('./helpers');
require('./sections/template-page');
require('./elements/header');
require('./elements/mobile-menu');
require('./elements/popup');
require('./elements/popup-registration');
require('./elements/popup-registration-step-2');
require('./elements/popup-autorization');
require('./elements/popup-your-mail-is-confirmed');
require('./elements/popup-new-password');
require('./elements/checkbox');
require('./elements/filter-dropdown');
require('./elements/activity-date');
require('./elements/activity-link');
require('./elements/collapse-tag-height');
require('./elements/filter-reset');
require('./elements/section-tags');
require('./elements/service');
require('./elements/video-page-width');
require('./sections/my-activities-page');
require('./sections/lk');
require('./sections/microcredit');
require('./elements/popup-reset-password');
require('./elements/dropdown');
require('./elements/articles-link');
require('./elements/personal-info');
require('./elements/replace-images-with-responsive-pictures');

window.lodashDebounce = require('lodash/debounce');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
// });
