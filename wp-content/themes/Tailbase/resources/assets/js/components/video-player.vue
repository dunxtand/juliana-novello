<template>
    <div class="mx-4">
        <video
            ref="video"
            muted
        >
            <source :type="type" :src="src"/>
        </video>
        <div class="flex justify-end mt-1 text-deep-purple">
            <a
                href="#"
                @click.prevent="play"
                class="mr-4"
            >
                play
            </a>
            <a
                href="#"
                @click.prevent="pause"
                class="mr-4"
            >
                pause
            </a>
            <a
                v-if="fullscreenSupported"
                href="#"
                @click.prevent="fullscreen"
            >
                fullscreen
            </a>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        type: {
            type: String,
            required: true,
        },
        src: {
            type: String,
            required: true
        }
    },

    mounted: function () {
        this.fullscreenSupported = document.fullscreenEnabled || document.mozFullscreenEnabled || document.webkitFullscreenEnabled || document.msFullscreenEnabled;

        this.$refs.video.addEventListener('ended', () => {
            setTimeout(() => this.$refs.video.currentTime = 0, 3000);
        });

        // note: add the option to turn this off
        this.$refs.video.addEventListener('play', () => {
            if (this.$refs.video.muted === true) {
                this.$refs.video.muted = false;
            }
        });
    },

    data: function () {
        return {
            fullscreenSupported: true
        };
    },

    methods: {
        play: function () {
            this.$refs.video.muted = false;
            this.$refs.video.play();
        },

        pause: function () {
            this.$refs.video.pause();
            this.$refs.video.muted = true;
        },

        fullscreen: function () {
            this.$refs.video.requestFullscreen();
        }
    }
}
</script>

<style lang="scss" scoped>
video {
    @media (min-width: 1024px) {
        width: 900px;
    }
}

// note: add the option to control these
::-webkit-media-controls-current-time-display,
::-webkit-media-controls-time-remaining-display,
::-webkit-media-controls-mute-button,
::-webkit-media-controls-timeline {
    display: none !important;
}
</style>
