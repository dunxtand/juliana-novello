<template>
    <div class="w-full relative my-16">
        <div class="flex flex-wrap items-center justify-center w-3/4 mx-auto">
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
                />
            </a>
        </div>

        <div
            v-show="!!shown"
            class="fixed top-0 shown-image flex justify-center items-center w-full h-screen"
        >
            <a
                href="#"
                @click.prevent="back"
                class="controls absolute left-0"
            >
                PREV
            </a>
            <img
                :src="shown"
                alt=""
            />
            <a
                href="#"
                @click.prevent="shown = null"
                class="controls absolute top-0 left-0"
            >
                X
            </a>
            <a
                href="#"
                @click.prevent="forward"
                class="controls absolute right-0"
            >
                NEXT
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
.shown-image {
    z-index: 100;
    background: rgba(0, 0, 0, .9);

    img {
        max-width: 85%;
        max-height: 95%;
        z-index: 101;
    }

    .controls {
        color: white;
        z-index: 101;
    }
}
</style>
