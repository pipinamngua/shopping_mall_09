
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
var Vue = require('vue');
Vue.use(require('vue-resource'));

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import categories from './components/categories/Categories.vue';
import colors from './components/colors/Colors.vue';
import sizes from './components/sizes/Sizes.vue';
import products from './components/products/Products.vue';
import addcolor from './components/products/addColor.vue';
import users from './components/users/Users.vue';
import discountprogram from './components/discountPrograms/DiscountProgram.vue';
import discountproducts from './components/discountProducts/discountProducts.vue';


const app = new Vue({
    el: '#app',
    components : {
        categories,
        colors,
        sizes,
        products,
        users,
        addcolor,
        discountprogram,
        discountproducts
    }
});
