import Vue from "vue";
import sal from "sal.js";
import 'lazysizes';

import components from './components';

for (const [name, component] of components) {
  Vue.component(name, component);
}

new Vue({
  el: '#app'
});
