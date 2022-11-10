<template>
    <div class="w-full h-full flex justify-between pt-4 pb-24">
        <div v-if="isLargeScreen()">
            <video
                v-for="(video, index) in allVideos"
                :key="index"
                ref="video"
                :class="{ show: selectedVideo && video.src === selectedVideo.src }"
                :data-src="video.src"
                muted
            >
                <source
                    v-if="selectedVideo && video.src === selectedVideo.src"
                    :type="video.type"
                    :src="video.src"
                />
            </video>
        </div>

        <div class="w-full h-full flex flex-col justify-center items-center mx-4">
            <a
                v-for="(project, index) in projects"
                :key="index"
                :href="project.link"
                :class="[
                    'flex mb-16 lg:mb-12',
                    {
                        selected: project.id === selected,
                        'not-selected': !!selected && selected !== project.id
                    }
                ]"
                @mouseenter="selected = project.id"
                @mouseleave="selected = null"
            >
                <h2 class="text-periwinkle">
                    {{ project.title }}
                </h2>
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
            selected: null,
            image: null
        };
    },

    watch: {
        selectedVideo: function (video) {
            if (video && video.src) {
                const v = this.$refs.video.find(r => r.dataset?.src === video.src);
                v.currentTime = 0;
                v.muted = false;
                v.play();
            } else {
                for (const vid of this.$refs.video) {
                    vid.pause();
                    vid.muted = true;
                }
            }
        }
    },

    computed: {
		projects: function () {
			return JSON.parse(this.itemsStr);
		},

        selectedVideo: function () {
            if (window.innerWidth < 1024) {
                return null;
            }

            const videos = (this.projects.find(v => v.id === this.selected) || { videos: [] }).videos;
            const randomIndex = Math.floor((Math.random()) * ((videos.length - 1) + 1));
            return videos[randomIndex] || null;
        },

        allVideos: function () {
            return this.projects.map(p => p.videos).flat();
        }
    },

    methods: {
        isLargeScreen: function () {
            return window.innerWidth >= 768;
        }
    }
}
</script>

<style lang="scss" scoped>
video {
    width: 1000px;
    max-width: 80%;
    max-height: 90%;
    position: absolute;
    z-index: 1;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    opacity: 0;
    transition: opacity .4s;
    &.show {
        opacity: 1;
    }
}

a {
    z-index: 10;
    &.selected {
        h2 {
            color: #93ff9b !important;
        }
    }

    &.not-selected {
        h2 {
            opacity: 0;
        }
    }

    h2 {
        font-size: 40px;
        letter-spacing: 1px;
        max-width: 900px;
        text-align: center;
        opacity: 1;
        transition: opacity .4s, color .1s;
    }
}

h2 {
    font-size: 40px;
    letter-spacing: 1px;
    text-align: center;
}
</style>
