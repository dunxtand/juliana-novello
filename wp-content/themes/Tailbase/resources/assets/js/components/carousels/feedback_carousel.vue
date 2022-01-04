<template>
    <div
        id="feedback-carousel"
        class="lg:py-10 text-white overflow-hidden"
    >
        <h4 class="border-t-2 border-white py-5">
            What Our Clients Say
        </h4>
        <div class="-mx-3 mt-12">
            <fade>
                <carousel
                    :per-page="1"
                    :per-page-custom="perPageCustom"
                    :loop="true"
                    :pagination-color="'#B0ACA7'"
                    :pagination-active-color="'#FFFFFF'"
                    class="w-10/12 lg:w-full"
                    ref="carousel"
                    v-show="feedback.length > 0"
                >
                    <slide
                        v-for="item in feedback"
                        :key="item.order"
                        :style="dragStyle"
                    >
                        <div class="mx-3">
                            <p class="text-2xl serif text-white">
                                {{ item.quote }}
                            </p>
                            <div class="text-lg mt-4 mb-8 flex flex-col text-stone">
                                <span>
                                    {{ item.attribution_name }}
                                </span>
                                <span>
                                    {{ item.attribution_title }}
                                </span>
                            </div>
                            <site-button
                                :url="item.case_study_url || 'javascript:void(0)'"
                                color="white"
                                class="inline-flex"
                            >
                                See Case Study
                            </site-button>
                        </div>
                    </slide>
                </carousel>
            </fade>
        </div>
    </div>
</template>

<script>
import CarouselBase from './carousel_base';
import SiteButton from '../global/site_button';
import { Fade } from '../transitions';
import { carouselData } from '../../store';
import { BREAKPOINT_LG } from '../../constants';


export default {
    extends: CarouselBase,

    mounted: function () {
        this.showOverflow();
    },

    computed: {
        feedback: () => carouselData.feedback,

        perPageCustom: () => [[BREAKPOINT_LG, 3]]
    },

    components: {
        SiteButton,
        Fade
    }
}
</script>

<style lang="scss">
// not scoped, so we can move the pagination dots
#feedback-carousel {
    background-color: #464440;

    .VueCarousel-dot-container {
        position: absolute;
        display: none;
        top: -138px;
        right: -50px;

        @media (min-width: 992px) {
            display: initial;
            right: 10px;
        }
    }

    .text-sm {
        color: #B0ACA7;
    }
}
</style>
