import Vue from "vue";
import sal from "sal.js";
import VueCarousel from 'vue-carousel';
import VueSmoothScroll from 'vue2-smooth-scroll';
import VueObserveVisibility from 'vue-observe-visibility';
import 'whatwg-fetch';
import 'lazysizes';

import components from './components';


Vue.use(VueCarousel);
Vue.use(VueSmoothScroll);
Vue.use(VueObserveVisibility);

for (const [name, component] of components) {
  Vue.component(name, component);
}

new Vue({ el: '#app' });
