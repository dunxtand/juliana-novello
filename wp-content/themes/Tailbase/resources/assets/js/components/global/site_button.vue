<template>
    <a
        :target="newTab ? '_blank' : ''"
        :href="href"
        :class="[
            'py-3 px-4 border-2 rounded-full flex flex-row justify-between items-center w-full lg:w-auto',
            `border-${color} text-${color}`
        ]"
        @mouseover="hover = true"
        @mouseleave="hover = false"
    >
        <div class="mr-4 sans-medium leading-5 lg:leading-none text-adjust">
            <slot />
        </div>

        <svg
            class="relative"
            :style="{ left: hover ? '7px' : 0 }"
            width="36" height="21" viewBox="0 0 36 21" fill="none" xmlns="http://www.w3.org/2000/svg"
        >
            <path d="M0 10.3916L34.1443 10.3916" stroke="#F8F5F2" stroke-width="2" stroke-miterlimit="10"/>
            <path d="M35.9998 10.125C30.4663 10.125 25.9824 5.59301 25.9824 1.17326e-05" stroke="#F8F5F2" stroke-width="2" stroke-miterlimit="10"/>
            <path d="M36.0001 10.6585C30.4665 10.6585 25.9827 15.1905 25.9827 20.7834" stroke="#F8F5F2" stroke-width="2" stroke-miterlimit="10"/>
        </svg>
    </a>
</template>

<script>
export default {
    props: {
        url: {
            type: String,
            default: 'javascript:void(0)'
       },
       type: {
           type: String,
           validator: val => ['mailto', 'tel'].includes(val)
        },
        newTab: {
            type: Boolean,
            default: false
        },
        color: {
            type: String,
            default: 'black',
            validator: val => ['black', 'white'].includes(val)
        }
    },

    data: function () {
        return {
            hover: false
        };
    },

    computed: {
        href: function () {
            return this.type ? `${this.type}:${this.url}` : this.url;
        }
    }
}
</script>

<style lang="scss" scoped>
svg {
    transition: .3s;

    path {
        stroke: currentColor;
    }
}
</style>
