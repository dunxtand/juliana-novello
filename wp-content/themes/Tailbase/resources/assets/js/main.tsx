import Vue from 'vue';
import components from './components';


for (const [name, component] of components) {
  Vue.component(name, component);
}

new Vue({ el: '#app' });
