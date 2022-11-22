<template>
    <div class="mx-4">
        <div class="relative">
            <video
                ref="video"
                muted
                disablepictureinpicture
                controlslist="nodownload noplaybackrate"
                :class="{ notimeline: !timeline, loading }"
            >
                <source :type="type" :src="`${src}#t=0.1`"/>
            </video>
            <div
                v-if="loading"
                class="spinner animate-spin"
            />
        </div>
        <div class="flex justify-end mt-1 text-periwinkle">
            <a
                href="#"
                @click.prevent="play"
            >
                play
            </a>
            <a
                href="#"
                @click.prevent="pause"
                class="ml-4"
            >
                pause
            </a>
            <a
                v-if="fullscreenSupported"
                href="#"
                @click.prevent="fullscreen"
                class="ml-4"
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
        },
        timeline: {
            type: Boolean,
            default: false
        },
        muted: {
            type: Boolean,
            default: false
        }
    },

    mounted: function () {
        this.fullscreenSupported = document.fullscreenEnabled || document.mozFullscreenEnabled || document.webkitFullscreenEnabled || document.msFullscreenEnabled;

        this.$refs.video.addEventListener('ended', () => {
            setTimeout(() => this.$refs.video.currentTime = 0, 3000);
        });

        this.$refs.video.addEventListener('canplaythrough', () => {
            this.loading = false;
        });

        if (!this.muted) {
            this.$refs.video.addEventListener('play', () => {
                if (this.$refs.video.muted === true) {
                    this.$refs.video.muted = false;
                }
            });
        }
    },

    data: function () {
        return {
            fullscreenSupported: true,
            loading: true
        };
    },

    methods: {
        play: function () {
            if (this.loading) return;

            if (!this.muted) {
                this.$refs.video.muted = false;
            }
            this.$refs.video.play();
        },

        pause: function () {
            if (this.loading) return;

            this.$refs.video.pause();
            this.$refs.video.muted = true;
        },

        fullscreen: function () {
            if (this.loading) return;

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
    &.loading {
        opacity: 0.5;
    }
}

.spinner {
    position: absolute;
    left: 0; 
    right: 0; 
    margin-left: auto; 
    margin-right: auto;
    top: 43%;
    width: 65px;
    height: 65px;
    border-radius: 100%;
    border: 5px solid #fff;
    border-top-color: #98b7ff;
}

::-webkit-media-controls-current-time-display,
::-webkit-media-controls-time-remaining-display,
::-webkit-media-controls-mute-button {
    display: none !important;
}

.notimeline {
    &::-webkit-media-controls-timeline {
        display: none !important;
    }
}
</style>
