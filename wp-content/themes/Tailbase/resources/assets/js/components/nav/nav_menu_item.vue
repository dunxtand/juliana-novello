<template>
    <li
        class="p-0 text-center ml-10 flex"
        data-sal="slide-down"
        data-sal-duration="800"
        :data-sal-delay="menu_order * 200"
        @mouseover="active = true"
        @mouseleave="active = false"
    >
        <a
            class="relative pb-1 flex flex-col justify-center"
            :href="url"
        >
            <div :class="[
                `bar-top bg-${barColor} absolute w-full`,
                { 'fold-down': active || current }
            ]">
            </div>

            <span>{{ name }}</span>

            <transition name="width">
                <div
                    v-show="active || current"
                    :class="`bar-bottom bg-${barColor} absolute w-full`"
                >
                </div>
            </transition>
        </a>
    </li>
</template>

<script>
export default {
    props: {
        current: {
            type: Boolean,
            required: true
        },
        url: {
            type: String,
            required: true
        },
        name: {
            type: String,
            required: true
        },
        menu_order: {
            type: Number,
            required: true
        },
        barColor: {
            type: String,
            default: 'black'
        }
    },

    data: function () {
        return {
            active: false
        };
    }
}
</script>

<style lang="scss" scoped>
.bar-top {
    transition: bottom .1s, background-color .4s;
    height: 7px;
    bottom: 96px;

    &.fold-down {
        transition: .2s;
        bottom: 89px;
    }
}
.bar-bottom {
    transition: background-color .4s;
    height: 2px;
    bottom: 36px;
}

.width-enter-active {
    transition: width 0.2s;
}
.width-leave-active {
    transition: width 0.1s;
}
.width-enter, .width-leave-to {
    width: 0;
}
</style>
