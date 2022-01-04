import Vue from 'vue';
import {
    SM, BREAKPOINT_SM,
    MD, BREAKPOINT_MD,
    LG, BREAKPOINT_LG,
    XL, BREAKPOINT_XL
} from './constants';


export const screen = Vue.observable({
    size: '',
    width: window.innerWidth
});

(() => {
    // track screen width
    const sizes = [
        [SM, BREAKPOINT_SM],
        [MD, BREAKPOINT_MD],
        [LG, BREAKPOINT_LG],
        [XL, BREAKPOINT_XL]
    ];

    function setSize () {
        screen.width = window.innerWidth;

        for (const [size, width] of sizes) {
            if (window.innerWidth > width) {
                screen.size = size;
                break;
            }
        }
    }

    setSize();
    window.addEventListener('resize', setSize);
})();


export const carouselData = Vue.observable({
    caseStudies: [],
    feedback: [],
    insights: []
});


export const navbar = Vue.observable({
    show: true
});
