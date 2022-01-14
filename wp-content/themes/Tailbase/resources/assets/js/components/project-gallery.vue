<template>
    <div class="w-full relative my-16">
        <div class="flex flex-wrap items-center justify-center w-full lg:w-3/4 mx-auto">
            <a
                v-for="(imageUrl, index) in items"
                :key="index"
                href="#"
                @click.prevent="shown = imageUrl"
                class="w-full lg:w-1/2"
            >
                <img
                    :src="imageUrl"
                    alt=""
                    class="image-item m-4"
                    :style="{
                        opacity: imageUrl ? 1 : 0
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
                class="controls controls-prev absolute left-0 ml-2"
            >
                &lArr;
            </a>
            <img
                :src="shown"
                alt=""
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
                class="controls controls-next absolute right-0 mr-2"
            >
                &rArr;
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
		items: function () {
			return JSON.parse(this.itemsStr);
		},

        currentIndex: function () {
            return this.items.findIndex(imageUrl => imageUrl === this.shown);
        }
    },

    methods: {
        back: function () {
            if (this.currentIndex - 1 < 0) {
                this.shown = this.items[this.items.length - 1];
            } else {
                this.shown = this.items[this.currentIndex - 1];
            }
        },

        forward: function () {
            if (this.currentIndex + 1 > (this.items.length - 1)) {
                this.shown = this.items[0];
            } else {
                this.shown = this.items[this.currentIndex + 1];
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
        max-width: 80%;
        max-height: 94%;
        z-index: 101;
        transition: opacity .3s;
    }

    .controls {
        color: white;
        z-index: 101;
    }

    .controls-prev, .controls-next {
        font-size: 50px;
    }

    .controls-close {
        font-size: 30px;
    }
}
</style>
