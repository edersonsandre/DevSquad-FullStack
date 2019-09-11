// require('./bootstrap');

window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('squad-upload-produto', require('./components/admin/ButtonUpload.vue').default);

const app = new Vue({
    el: '#vue-admin',

});


