<template>
    <div v-observe-visibility="visibilityChanged">
        <slot name="fallback" v-if="failed" />
    </div>
</template>

<script>
import lottie from 'lottie-web';


const DATA_PATH = '/wp-content/themes/Tailbase/resources/vue-anim/';


export default {
    props: {
        path: {
            type: String,
            required: true
        },
        renderer: {
            type: String,
            default: 'svg'
        },
        loop: {
            type: Boolean,
            default: false
        },
        autoplay: {
            type: Boolean,
            default: true
        },
        whenVisible: {
            type: Boolean,
            default: false
        }
    },

    mounted: function () {
        this.$el.addEventListener('data_failed', console.log);
        if (!this.whenVisible) {
            this.load();
        }
    },

    data: function () {
        return {
            visible: false,
            loaded: false,
            failed: false
        };
    },

    watch: {
        visible: function (val) {
            if (val && !this.loaded) {
                this.load();
            }
        }
    },

    methods: {
        load: function () {
            const animation = lottie.loadAnimation({
                container: this.$el,
                renderer: this.renderer,
                loop: this.loop,
                autoplay: this.autoplay,
                path: DATA_PATH + this.path + '/animation.json'
            });
            animation.addEventListener('data_failed', () => this.failed = true);
            animation.addEventListener('data_ready', () => this.loaded = true);
        },

        visibilityChanged: function (visible) {
            if (!this.visible) {
                this.visible = visible;
            }
        }
    }
}
</script>
