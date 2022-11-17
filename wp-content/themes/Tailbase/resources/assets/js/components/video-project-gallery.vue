<template>
    <div class="w-full mb-2 lg:mb-10 mt-20 lg:mt-24">
        <div
            @scroll="handleScroll"
            ref="track"
            class="track flex items-center bg-transparent pb-4"
        >
            <div
                v-for="(src, index) in images"
                :key="index"
                class="mx-4 shrink-0"
            >
                <img :src="src" />
            </div>
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

    mounted: function () {
        this.images = this.originalImages;
    },

    data: function () {
        return {
            images: []
        };
    },

    computed: {
        originalImages: function () {
            return JSON.parse(this.itemsStr)
        },
    },

    methods: {
        handleScroll: function () {
            const scrollableWidth = this.$refs.track.scrollWidth - this.$refs.track.clientWidth;
            if (this.$refs.track.scrollLeft >= (scrollableWidth - 100)) {
                this.images = this.images.concat(this.originalImages);
            }
        }
    }
}
</script>

<style lang="scss" scoped>
.track {
    overflow-x: scroll;
}
</style>
