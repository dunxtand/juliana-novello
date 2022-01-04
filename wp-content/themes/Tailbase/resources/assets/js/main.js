import Vue from "vue";
import sal from "sal.js";
import VueCarousel from 'vue-carousel';
import VueSmoothScroll from 'vue2-smooth-scroll';
import VueObserveVisibility from 'vue-observe-visibility';
import 'whatwg-fetch';
import 'lazysizes';

import mySplit from './mySplit';
import components from './components';
import filters from './filters';


Vue.use(VueCarousel);
Vue.use(VueSmoothScroll);
Vue.use(VueObserveVisibility);

for (const [name, component] of components) {
  Vue.component(name, component);
}

for (const [name, filter] of filters) {
  Vue.filter(name, filter);
}

new Vue({
  el: '#app',

  mounted: function () {

    mySplit();


    let threshold = 0.5; // this is already sal's default value

    // option for custom threshold via first element on page with data-sal-threshold attribute
    const customThresholdEl = document.querySelector('[data-sal-threshold]');
    if (customThresholdEl) {
      try {
        threshold = parseFloat(customThresholdEl.dataset.salThreshold) || 0.5;
      } catch {}
    }

    // get rid of data-sal attribute for wysiwyg elements that are too tall
    // borrowed partially from https://github.com/mciastek/sal/issues/62
    for (const wysiwyg of document.querySelectorAll('#wysiwyg')) {
      const height = wysiwyg.getBoundingClientRect().height;
      if ((height * threshold) > window.innerHeight) {
        wysiwyg.removeAttribute('data-sal');
      }
    }

    sal({ threshold });

    // lazyload wysiwyg assets
    for (const el of document.querySelectorAll('.wysiwyg img, .wysiwyg iframe')) {
      try {
        el.classList.add('lazyload');
      } catch {}
    }
  }
});
