<template>
    <div class="w-full overflow-x-visible relative">
        <carousel
            :per-page="1"
            :pagination-enabled="true"
            :navigate-to="slideIndex"
            :class="[
                'twig-carousel w-11/12 pb-16',
                carouselClass
            ]"
            ref="carousel"
        >
            <slot/> <!-- <slide> compoennts rendered in Twig files -->
        </carousel>
        <left-arrow
            @click.native="navigate(slideIndex - 1)"
            :class="`absolute bottom-0 left-0 mb-4 ml-${arrowMx}`"
        />
        <right-arrow
            @click.native="navigate(slideIndex + 1)"
            :class="`absolute bottom-0 right-0 mb-4 mr-${arrowMx}`"
        />
    </div>
</template>

<script>
import CarouselBase from './carousel_base';
import LeftArrow from './left_arrow.vue';
import RightArrow from './right_arrow';


export default {
    extends: CarouselBase,

    props: {
        arrowMx: {
            type: [String, Number],
            default: 0
        },
        carouselClass: {
            type: String,
            default: ''
        }
    },

    mounted: function () {
        this.showOverflow();
        this.$watch('$refs.carousel.currentPage', index => this.slideIndex = index);
    },

    computed: {
        slides: function () {
            return this.$slots.default.filter(slot => slot.elm instanceof HTMLElement);
        }
    },

    components: {
        LeftArrow,
        RightArrow
    }
}
</script>

<style lang="scss">
.twig-carousel {
    .VueCarousel-pagination {
        position: absolute;
        bottom: 10px;
        left: 7%;
        pointer-events: none;
    }
}
</style>
