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
