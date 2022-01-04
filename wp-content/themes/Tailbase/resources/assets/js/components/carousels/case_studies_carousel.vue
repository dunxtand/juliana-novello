<template>
    <div class="case-studies-car-height relative lg:border-t-2 border-black overflow-x-hidden overflow-y-visible">
        <fade>
            <carousel
                class="my-4 -mx-2"
                :per-page="1"
                :navigate-to="slideIndex"
                :loop="true"
                :autoplay="true"
                :autoplay-timeout="6000"
                :pagination-enabled="false"
                :navigation-enabled="false"
                ref="carousel"
                v-show="slides.length > 0"
            >
                <slide
                    v-for="(item, index) in slides"
                    :key="index"
                    class="case-studies-car-height flex flex-row"
                    :style="dragStyle"
                >
                    <div class="w-full lg:w-1/3 flex flex-col justify-between lg:mr-6 mx-2">
                        <div class="mt-2 text-xxs md:text-xs uppercase sans-bold tracking-wider hidden lg:flex">
                            <div
                                v-for="(workType, index) in item.work_types"
                                :key="workType"
                            >
                                {{ workType }}<span v-if="item.work_types.length !== (index + 1)" class="mx-2">|</span>
                            </div>
                        </div>

                        <!-- mobile image -->
                        <img
                            :src="item.image"
                            class="lg:hidden lazyload"
                        />

                        <div class="flex flex-col">
                            <a
                                :href="item.link"
                                class="serif text-4xl lg:text-5xl my-6 leading-tight"
                                @mouseover="hover = true"
                                @mouseout="hover = false"
                            >
                                {{ item.title }}
                            </a>
                            <p>
                                {{ item.tagline }}
                            </p>
                            <div class="w-full flex justify-center lg:justify-start mt-4">
                                <div>
                                    <site-button
                                        :url="item.link"
                                        @mouseover.native="hover = true"
                                        @mouseout.native="hover = false"
                                    >
                                        See Case Study
                                    </site-button>
                                </div>
                            </div>
                        </div>

                        <div class="w-full flex justify-between mt-16 lg:mt-0">
                            <a
                                href="#"
                                @click.prevent="navigate(slideIndex - 1)"
                                class="case-studies-carousel-navgiate-left"
                            >
                                <svg width="120" height="21" viewBox="0 0 120 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M120 10.7834L2 10.7834" stroke="black" stroke-width="2" stroke-miterlimit="10"/>
                                    <path d="M0.000161321 10.6584C5.53373 10.6584 10.0176 15.1904 10.0176 20.7834" stroke="black" stroke-width="2" stroke-miterlimit="10"/>
                                    <path d="M0.000160879 10.125C5.53373 10.125 10.0176 5.593 10.0176 0" stroke="black" stroke-width="2" stroke-miterlimit="10"/>
                                </svg>
                            </a>

                            <div class="text-lg lg:text-xl">
                                {{ (index + 1) | withLeadingZero }} / {{ slides.length | withLeadingZero }}
                            </div>

                            <a
                                href="#"
                                @click.prevent="navigate(slideIndex + 1)"
                                class="case-studies-carousel-navgiate-right"
                            >
                                <svg width="120" height="21" viewBox="0 0 120 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 10L118 10" stroke="black" stroke-width="2" stroke-miterlimit="10"/>
                                    <path d="M120 10.125C114.466 10.125 109.982 5.59301 109.982 1.17326e-05" stroke="black" stroke-width="2" stroke-miterlimit="10"/>
                                    <path d="M120 10.6585C114.466 10.6585 109.982 15.1905 109.982 20.7834" stroke="black" stroke-width="2" stroke-miterlimit="10"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <a
                        :href="item.link"
                        @mouseover="hover = true"
                        @mouseout="hover = false"
                        class="hidden lg:block lg:w-2/3 overflow-hidden"
                    >
                        <img
                            :src="item.image"
                            :style="imgStyle"
                            class="lazyload w-full h-full object-cover"
                        />
                    </a>
                </slide>
            </carousel>
        </fade>
        <fade>
            <div
                v-show="slides.length === 0"
                class="animate-spin absolute left-0 right-0 border-black border-2 rounded-full w-24 h-24 mx-auto"
            >
            </div>
        </fade>
    </div>
</template>

<script>
import CarouselBase from './carousel_base';
import { Fade } from '../transitions';
import { carouselData } from '../../store';


export default {
    extends: CarouselBase,

    data: function () {
        return {
            hover: false
        };
    },

    computed: {
        slides: () => carouselData.caseStudies,

        imgStyle: function () {
            return {
                transform: `scale(${this.hover ? 1.15 : 1.05})`
            };
        }
    },

    watch: {
        slides: function (val) {
            if (val.length > 0) {
                this.$nextTick(() => {
                    this.$watch('$refs.carousel.currentPage', index => this.slideIndex = index);
                });
            }
        }
    },

    filters: {
        withLeadingZero: function (num) {
            return num < 10 ? `0${num}` : num;
        }
    },

    components: {
        Fade
    }
}
</script>

<style lang="scss" scoped>
img, .case-studies-carousel-navgiate-left, .case-studies-carousel-navgiate-right {
    transition: .35s;
}

.case-studies-car-height {
    @media (min-width: 992px) {
        min-height: 700px;
    }
}
.row {
    margin-left: 0;
    margin-right: 0;
}

.col-4 {
    padding-left: 0;
}

.animate-spin {
    top: 50%;
    border-color: #F8F5F2;
    border-top-color: #958F86;
}

.case-studies-carousel-navgiate-left:hover {
    transform: translateX(-10px);
}

.case-studies-carousel-navgiate-right:hover {
    transform: translateX(10px);
}
</style>
