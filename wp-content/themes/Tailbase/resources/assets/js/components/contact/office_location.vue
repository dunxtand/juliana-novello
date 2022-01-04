<template>
    <div>
        <a
            href="#"
            @click.prevent="open = !open"
            class="w-full flex flex-row justify-between items-center mb-2"
        >
            <slot name="city" />

            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <line x1="8" y1="4.37114e-08" x2="8" y2="15" stroke="white" stroke-width="2"/>
                <line x1="15" y1="8" x2="-8.74228e-08" y2="8" stroke="white" stroke-width="2"/>
            </svg>
        </a>
        <slide-down
            transition=".35s"
            height-zero
        >
            <div v-show="open">
                <slot name="location" />
                <div class="h-1"></div>
            </div>
        </slide-down>
    </div>
</template>

<script>
import { SlideDown } from '../transitions';


export default {
    data: function () {
        return {
            open: false
        };
    },

    components: {
        SlideDown
    }
}
</script>
