<template>
    <div
        id="insights-carousel"
        class="py-10 overflow-hidden"
    >
        <h4 class="text-md border-t-2 border-black py-6">
            Insights
        </h4>
        <div class="-mx-4">
            <fade>
                <carousel
                    :per-page="1"
                    :per-page-custom="perPageCustom"
                    class="w-10/12 lg:w-full"
                    ref="carousel"
                    v-show="insights.length > 0"
                >
                    <slide
                        v-for="item in insights"
                        :key="item.order"
                        :style="dragStyle"
                    >
                        <div class="live-insight flex flex-col mx-4">
                            <div class="overflow-hidden w-full">
                                <a :href="item.link" class="insight-title inline-block">
                                <img
                                    :src="item.image"
                                    :alt="item.title"
                                    class="w-full lazyload img-zoom object-cover"
                                />
                                </a>
                            </div>

                            <span class="mt-4">
                                {{ item.date }}
                            </span>

                            <h4 class="underline">
                                <a :href="item.link" class="insight-title inline-block">
                                    {{ item.title }}
                                </a>
                            </h4>

                            <p class="my-4">
                                {{ item.description }}
                            </p>
                            
                            <div>
                                <a :href="item.link" class="insight-title inline-block">
                                    <span>Keep Reading</span>
                                    <hr class="bg-black"/>
                                </a>
                            </div>
                        </div>
                    </slide>
                </carousel>
            </fade>
        </div>
        <div class="flex justify-center mt-16 lg:mt-20">
            <div>
                <site-button url="/insights">
                    Explore All Insights
                </site-button>
            </div>
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
        insights: () => carouselData.insights,

        perPageCustom: () => [[BREAKPOINT_LG, 3]]
    },

    components: {
        SiteButton,
        Fade
    }
}
</script>

<style lang="scss">
#insights-carousel {
    .VueCarousel-dot-container {
        position: absolute;
        top: -90px;
        right: -55px;
    }

    img {
        height: 250px;
    }
}
</style>
