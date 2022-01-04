<template>
    <div>
        <!-- floating button -->
        <svg
            class="z-10 fixed lg:hidden"
            @click="open = true"
            :style="loaded ? null : 'transform: translateY(150%)'"
            width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg"
        >
            <g filter="url(#filter0_d)">
            <circle cx="34" cy="30" r="30" fill="black"/>
            <line x1="24.4" y1="19.4" x2="43.6" y2="19.4" stroke="white" stroke-width="2"/>
            <line x1="13.6" y1="30.9" x2="54.4" y2="30.9" stroke="white" stroke-width="2"/>
            <line x1="24.4" y1="42.2" x2="43.6" y2="42.2" stroke="white" stroke-width="2"/>
            </g>
            <defs>
            <filter id="filter0_d" x="0" y="0" width="100" height="100" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
            <feFlood flood-opacity="0" result="BackgroundImageFix"/>
            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
            <feOffset dy="4"/>
            <feGaussianBlur stdDeviation="2"/>
            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
            <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow"/>
            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"/>
            </filter>
            </defs>
        </svg>

        <!-- menu -->
        <transition name="fade">
            <nav
                class="fixed top-0 left-0 z-30 visible lg:hidden w-full h-full pt-8 flex flex-col"
                v-show="open"
            >
                <a href="/" class="flex justify-center">
                    <svg
                        class="logo-hero block mb-6"
                        width="96" height="95" viewBox="0 0 96 95" fill="none" xmlns="http://www.w3.org/2000/svg"
                    >
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M48.39 95C22.1996 95 0.890015 73.6904 0.890015 47.5C0.890015 21.3096 22.1996 0 48.39 0C74.5804 0 95.89 21.3096 95.89 47.5C95.89 73.6904 74.5804 95 48.39 95ZM48.39 1.36907C22.9526 1.36907 2.25909 22.0626 2.25909 47.5C2.25909 72.9374 22.9526 93.6309 48.39 93.6309C73.8274 93.6309 94.5209 72.9374 94.5209 47.5C94.5209 22.0626 73.8274 1.36907 48.39 1.36907ZM63.2514 39.2239C63.2514 34.35 60.1162 31.208 54.195 30.1401L53.5721 30.0306L54.1813 29.8663C60.3011 28.1961 61.5811 24.1641 61.5811 21.07C61.5811 15.6964 57.4192 12.972 49.2116 12.972H45.0427C44.0089 12.972 42.8738 12.9855 41.7312 12.9991L41.709 12.9993C40.5316 13.013 39.3405 13.0267 38.2179 13.0267H33.5288C34.9048 16.4494 35.4592 18.3661 35.4592 23.24V38.4504C35.4592 43.0916 34.9732 45.0973 33.5288 48.6637H49.7934C58.5966 48.65 63.2514 45.3848 63.2514 39.2239ZM43.9612 13.9782L44.0775 13.9577C44.8648 13.8208 45.6794 13.7592 46.802 13.7592C51.1351 13.7592 53.5173 16.5795 53.5173 21.7066C53.5173 25.5743 51.8196 29.702 47.0416 29.702H43.9543V13.9782H43.9612ZM44.0844 47.7053L43.9612 47.6848V30.5372H47.1922C51.9429 30.5372 54.4483 33.4738 54.4483 39.0186C54.4483 44.7755 51.7649 47.9449 46.8978 47.9449C46.0559 47.9518 45.1386 47.8696 44.0844 47.7053ZM58.6855 64.6955H63.5046C62.1492 66.1741 61.143 67.4542 59.8013 70.7537L54.4208 84.5539H53.038L48.4037 70.9864L42.7768 84.5539H41.3941L36.2943 70.7126C35.0484 67.2762 34.227 65.8661 33.2755 64.6887H43.0575C42.3798 65.7223 42.1745 68.2551 43.037 70.7537L45.1727 77.291L48.0752 70.0691L48.0615 70.0281C46.8841 66.7697 46.3364 65.647 45.426 64.6955H55.03C54.325 65.8182 54.3044 68.3715 55.0027 70.7605L56.8509 76.7023L59.0072 71.137C60.2188 68.2893 59.5685 65.7292 58.6855 64.6955ZM14.9571 56.1457H81.8158V57.5148H14.9571V56.1457Z" fill="white"/>
                    </svg>
                </a>
                <ul class="flex flex-col justify-around bg-white text-white w-full px-10">
                    <li
                        v-for="(item, index) in items"
                        :key="item.order"
                        class="text-4xl serif text-white"
                        data-sal="slide-down"
                        data-sal-duration="600"
                        :data-sal-delay="index * 100"
                    >
                        <a :href="item.url">
                            {{ item.name }}
                        </a>
                    </li>
                </ul>
                <svg
                    class="block mx-auto mt-auto mb-16"
                    @click="open = false"
                    width="68" height="68" viewBox="0 0 68 68" fill="none" xmlns="http://www.w3.org/2000/svg"
                >
                    <g filter="url(#filter0_d)">
                    <circle cx="34" cy="30" r="30" fill="#0066FF"/>
                    <line x1="20.2821" y1="15.2929" x2="49.1321" y2="44.1428" stroke="white" stroke-width="2"/>
                    <line x1="19.2929" y1="44.1428" x2="48.1428" y2="15.2929" stroke="white" stroke-width="2"/>
                    </g>
                    <defs>
                    <filter id="filter0_d" x="0" y="0" width="68" height="68" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                    <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
                    <feOffset dy="4"/>
                    <feGaussianBlur stdDeviation="2"/>
                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow"/>
                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"/>
                    </filter>
                    </defs>
                </svg>
            </nav>
        </transition>
    </div>
</template>

<script>
import { validateJSON } from '../../helpers';

export default {
    props: {
        itemsstr: {
            type: String,
            required: true,
            validator: validateJSON
        }
    },

    mounted: function () {
        this.loaded = true;
    },

    data: function () {
        return {
            open: false,
            loaded: false
        };
    },

    computed: {
        items: function () {
            return JSON.parse(this.itemsstr).map(item => ({
                order: item.menu_order,
                name: item.name,
                url: item.url
            }));
        }
    },

    watch: {
        open: function (val) {
            document.body.style.overflow = this.open ? 'hidden' : '';
        }
    }
}
</script>

<style lang="scss" scoped>
div > svg {
    bottom: 30px;
    left: calc(50% - 34px);

    transition: transform .5s;
    transition-delay: 1.5s;
}

nav, ul {
    background-color: #464440;
}

ul {
    height: 65%;
}

.fade-enter-active, .fade-leave-active {
    transition: opacity 0.15s;
}
.fade-enter, .fade-leave-to {
    opacity: 0;
}
</style>
