<template>
    <div
        v-if="video"
        class="text-white flex justify-between"
    >
        <a
            href="#"
            @click.prevent="play"
            :class="[
                'play text-2xl flex items-center mr-2',
                { 'pointer-events-none': !paused }
            ]"
        >
            &#9658;
        </a>
        <a
            href="#"
            @click.prevent="pause"
            :class="[
                'pause flex items-center',
                { 'pointer-events-none': paused }
            ]"
        >
            <span></span>
            <span></span>
        </a>
    </div>
</template>

<script>
export default {
    props: {
        selector: {
            type: String,
            required: true
        }
    },

    mounted: function () {
        const video = document.querySelector(this.selector);
        
        if (video instanceof HTMLVideoElement) {
            this.video = video;
            this.paused = !video.autoplay;
            // just in case autoplay fails
            setTimeout(() => this.paused = video.paused, 1500);
        }
    },

    data: function () {
        return {
            video: null,
            paused: true
        };
    },

    methods: {
        play: function () {
            this.video.play();
            this.paused = false;
        },

        pause: function () {
            this.video.pause();
            this.paused = true;
        }
    }
}
</script>

<style lang="scss" scoped>
.pause {
    margin-bottom: 6px;

    span {
        width: 4px;
        height: 19px;
        background-color: #fff;

        &:first-of-type {
            margin-right: 5px;
        }
    }
}

.play, .pause {
    transition: transform .15s;

    &:hover {
        transform: scale(1.15);
    }
}
</style>
