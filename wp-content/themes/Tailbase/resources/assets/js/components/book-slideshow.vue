<template>
    <div class="slideshow-container w-full flex justify-center items-center">
        <a
            href="#"
            @click.prevent="back"
            class="controls controls-prev ml-2 lg:ml-0 lg:mr-4"
        >
            ➬
        </a>
        <fade-list
            tag="div"
            class="image-container"
        >
            <div
                v-for="({ type, src }, index) in items"
                :key="src"
                v-show="selected === index"
            >
                <video-player
                    v-if="type === 'mp4'"
                    :type="`video/${type}`"
                    :src="src"
                    timeline
                    muted
                    ref="video"
                />
                <img
                    v-else
                    :src="src"
                    v-show="selected === index"
                />
            </div>
        </fade-list>
        <a
            href="#"
            @click.prevent="forward"
            class="controls controls-next mr-2 lg:mr-0 lg:ml-4"
        >
            ➫
        </a>
    </div>
</template>

<script>
import { validateJSON } from '../helpers';
import VideoPlayer from './video-player';
import { FadeList } from './transitions';


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
            selected: 0
        };
    },

    computed: {
        items: function () {
            return JSON.parse(this.itemsStr).map(src => {
                const splitByDot = src.split('.');
                return {
                    type: splitByDot[splitByDot.length - 1],
                    src: src
                };
            });
        }
    },

    watch: {
        selected: function () {
            for (const video of (this.$refs.video || [])) {
                video.pause();
            }
        }
    },

    methods: {
        back: function () {
            if (this.selected - 1 < 0) {
                this.selected = this.items.length - 1;
            } else {
                this.selected -= 1;
            }
        },

        forward: function () {
            if (this.selected + 1 > (this.items.length - 1)) {
                this.selected = 0;
            } else {
                this.selected += 1;
            }
        }
    },

    components: {
        FadeList,
        VideoPlayer
    }
}
</script>

<style lang="scss" scoped>
.slideshow-container {
    height: 300px;
    @media(min-width: 640px) {
        margin-top: 75px;
        height: 500px;
    }
}

.image-container {
    max-width: 900px;
    img {
        margin: 0 auto;
    }
}

.controls-prev, .controls-next {
    font-size: 50px;
}

.controls-prev {
    transform: rotate(180deg);
}
</style>
