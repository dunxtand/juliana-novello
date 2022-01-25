<template>
    <div class="w-full relative my-16">
        <div class="flex flex-wrap items-center justify-center w-full lg:w-3/4 mx-auto">
            <a
                v-for="(src, index) in images"
                :key="index"
                href="#"
                @click.prevent="shown = src"
                class="w-full lg:w-1/2"
            >
                <img
                    :src="src"
                    alt=""
                    class="image-item m-4"
                    :style="{
                        opacity: src ? 1 : 0
                    }"
                />
            </a>
        </div>

        <div
            :class="[
                'fixed top-0 lightbox flex justify-center items-center w-full h-screen',
                { shown }
            ]"
            :style="{
                opacity: shown ? 1 : 0,
                'z-index': shown ? 100 : -100
            }"
        >
            <a
                href="#"
                @click.prevent="back"
                class="controls controls-prev absolute bottom-0 sm:bottom-auto left-0 ml-4"
            >
                ➬
            </a>
            <img
                v-for="(src, index) in images"
                :key="index"
                :src="src"
                :class="{ show: src === shown }"
            />
            <a
                href="#"
                @click.prevent="shown = null"
                class="controls controls-close absolute top-0 right-0 mt-2 mr-6"
            >
                &#x2715;
            </a>
            <a
                href="#"
                @click.prevent="forward"
                class="controls controls-next absolute bottom-0 sm:bottom-auto right-0 mr-4"
            >
                ➫
            </a>
        </div>
    </div>
</template>

<script>
import { validateJSON } from '../helpers';


export default {
    props: {
		itemsStr: {
			type: String,
			required: true,
			validator: validateJSON
		}
    },

    data: function () {
        return {
            shown: null
        };
    },

    computed: {
		images: function () {
			return JSON.parse(this.itemsStr);
		},

        currentIndex: function () {
            return this.images.findIndex(src => src === this.shown);
        }
    },

    methods: {
        back: function () {
            if (this.currentIndex - 1 < 0) {
                this.shown = this.images[this.images.length - 1];
            } else {
                this.shown = this.images[this.currentIndex - 1];
            }
        },

        forward: function () {
            if (this.currentIndex + 1 > (this.images.length - 1)) {
                this.shown = this.images[0];
            } else {
                this.shown = this.images[this.currentIndex + 1];
            }
        }
    }
}
</script>

<style lang="scss" scoped>
.image-item {
    max-width: 90%;
}
.lightbox {    
    background: rgba(0, 0, 0, .8);

    &.shown {
        transition: opacity .3s, z-index 0s;
    }

    img {
        position: absolute;
        opacity: 0;
        max-height: 94%;
        z-index: 101;
        transition: opacity .3s;
        max-width: 100%;
        @media(min-width: 640px) {
            max-width: 80%;
        }
        &.show {
            opacity: 1;
        }
    }

    .controls {
        color: white;
        z-index: 101;
    }

    .controls-prev, .controls-next {
        font-size: 50px;
        z-index: 102;
    }

    .controls-prev {
        transform: rotate(180deg);
    }

    .controls-close {
        font-size: 30px;
    }
}
</style>
