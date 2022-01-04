<template>
    <marquee-text :repeat="4">
        <div
            class="flex flex-row items-center mr-10"
            :style="{ 'margin-left': marginLeft }"
        >
            <svg class="mr-4" width="30" height="32" viewBox="0 0 42 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M42 18.0782L41.5676 16.1295L32.6138 16.2278L38.2709 9.06364L37.0649 7.49981L29.0394 11.5977L31.1221 2.61183L29.3766 1.74395L23.8702 9.03089L21.97 0H20.03L18.1298 9.03089L12.6234 1.74395L10.8779 2.61183L12.9606 11.5977L4.93511 7.49981L3.7291 9.06364L9.38623 16.2278L0.432417 16.1295L0 18.0782L8.10881 22L0 25.9218L0.432417 27.8705L9.38623 27.7722L3.7291 34.9364L4.93511 36.5002L12.9606 32.4023L10.8779 41.3882L12.6234 42.256L18.1298 34.9691L20.03 44H21.97L23.8702 34.9691L29.3766 42.256L31.1221 41.3882L29.0394 32.4023L37.0649 36.5002L38.2709 34.9364L32.6138 27.7722L41.5676 27.8705L42 25.9218L33.8912 22L42 18.0782Z" fill="#FFB800"/>
            </svg>
            <span>
                <slot />
            </span>
        </div>
    </marquee-text>
</template>

<script>
import MarqueeText from 'vue-marquee-text-component';


export default {
    props: {
        order: {
            type: [Number, String],
            required: true,
            validator: val => !!parseInt(val)
        }
    },

    computed: {
        marginLeft: function () {
            return `${parseInt(this.order) * 70}px`;
        }
    },

    components: {
        MarqueeText
    }
}
</script>
