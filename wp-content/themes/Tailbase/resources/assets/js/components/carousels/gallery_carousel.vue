<template>
    <carousel
        :per-page="1"
        :autoplay="true"
        :autoplay-timeout="autoplayTimeout"
        :loop="true"
    >
        <slot />
    </carousel>
</template>

<script>
import CarouselBase from './carousel_base';


export default {
    extends: CarouselBase,

    props: {
        speed: {
            type: [String, Number],
            validator: val => !!parseInt(val),
            default: 3
        }
    },

    computed: {
        autoplayTimeout: function () {
            return parseInt(this.speed) * 1000;
        }
    }
}
</script>
