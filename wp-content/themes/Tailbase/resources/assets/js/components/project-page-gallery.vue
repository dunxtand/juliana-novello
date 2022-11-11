<template>
    <div class="w-full relative">
        <div class="lightbox flex justify-center items-center w-full">
            <a
                href="#"
                @click.prevent="back"
                class="controls controls-prev absolute left-0 ml-4"
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
                @click.prevent="forward"
                class="controls controls-next absolute right-0 mr-4"
            >
                ➫
            </a>
        </div>
    </div>
</template>

<script>
import { validateJSON } from '../helpers';


export default {
    mounted: function () {
        this.shown = this.images[0];
    },

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
    height: 50vh;

    @media (min-width: 640px) {
        height: 72vh;
    }

    img {
        position: absolute;
        max-height: 100%;
        opacity: 0;
        transition: opacity .3s;
        max-width: 100%;
        @media (min-width: 640px) {
            max-width: 80%;
        }
        &.show {
            opacity: 1;
        }
    }

    .controls {
        color: white;
    }

    .controls-prev, .controls-next {
        font-size: 50px;
        z-index: 100;
        bottom: -65px;
        @media (min-width: 640px) {
            bottom: auto;
        }
    }

    .controls-prev {
        transform: rotate(180deg);
    }

    .controls-close {
        font-size: 30px;
    }
}
</style>
