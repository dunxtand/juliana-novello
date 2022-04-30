<template>
    <div class="w-full h-full flex justify-between pt-4 pb-24">
        <video
            ref="video"
            :class="{ show: !!selected }"
            muted
        >
            <source
                v-if="selectedVideo"
                :type="selectedVideo.type"
                :src="selectedVideo.src"
            />
        </video>

        <div class="w-full h-full flex flex-col justify-center items-center mx-4">
            <a
                v-for="(project, index) in projects"
                :key="index"
                :href="project.link"
                :class="[
                    'flex mb-16 lg:mb-0',
                    {
                        selected: selected === project.id,
                        'not-selected': !!selected && selected !== project.id
                    }
                ]"
                @mouseenter="selected = project.id"
                @mouseleave="selected = null"
            >
                <h2 class="text-ocean">
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
            console.log(video);
            if (video && video.src) {
                this.$refs.video.currentTime = 0;
                this.$refs.video.muted = false;
                this.$refs.video.play();
            } else {
                this.$refs.video.pause();
                this.$refs.video.muted = true;
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
            color: #ccf4f9;
        }
    }

    &.not-selected {
        h2 {
            opacity: 0;
        }
    }

    h2 {
        font-size: 45px;
        max-width: 900px;
        text-align: center;
        opacity: 1;
        transition: opacity .4s, color .1s;
    }
}

h2 {
    font-size: 45px;
    text-align: center;
}
</style>
