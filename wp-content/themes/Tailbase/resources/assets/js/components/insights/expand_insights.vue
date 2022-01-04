<template>
    <div class="mt-10 lg:mt-0 mb-12 lg:mb-20 w-full h-auto">
        <fade-list
            tag="div"
            :class="[
                FILL_HEIGHT ? 'insights-fill-height' : 'insights-top-align',
                'insight-container w-full mx-0 lg:-mx-2'
            ]"
        >
            <div
                v-for="num in numToShow"
                :key="num"
                class="item mb-10 lg:mb-0 w-full"
            >
                <slot :name="`insight-${num}`"></slot>
            </div>
        </fade-list>
        <div
            class="col col-12 flex flex-row justify-center mt-12"
            :key="'load-more'"
        >
            <a
                href="#"
                v-show="moreToShow"
                @click.prevent="numToShow += 6"
                class="w-2/3 lg:w-1/3 border border-black rounded-full text-center py-2"
            >
                Load More
            </a>
        </div>
    </div>
</template>

<script>
import { FadeList } from '../transitions';
import imagesLoaded from 'imagesLoaded';


// true: grid items will fill available vertical space
// false: grid items will top-align by row
const FILL_HEIGHT = false;


export default {
    data: function () {
        return {
            numToShow: 6,
            updateSize: true
        };
    },

    computed: {
        FILL_HEIGHT: () => FILL_HEIGHT,

        moreToShow: function () {
            let show = !!this.$slots[`insight-${this.numToShow + 1}`];
            if (!show) {
                this.$el.style.marginBottom = '0px';
            }
            return show;
        }
    },

    mounted: function () {
        let grid = this.$el.getElementsByClassName('insight-container')[0];
        this.resizeAllGridItems( grid );
    },

    updated: function () {
        if (this.updateSize) {
            let grid = this.$el.getElementsByClassName('insight-container')[0];
            this.resizeAllGridItems( grid );
            this.updateSize = false;
        }
    },

    watch: {
        numToShow: function () {
           this.updateSize = true;
        }
    },

    methods: {
        resizeAllGridItems: function (grid) {
            let allItems = grid.getElementsByClassName('item');
            for (let x = 0; x < allItems.length; x++) {
                imagesLoaded( allItems[x], this.resizeGridItem);
            }
        },

        resizeGridItem: function (imagesLoadedItem) {
            let item = imagesLoadedItem.elements[0];
            let grid = this.$el.getElementsByClassName('insight-container')[0];

            if ( item.querySelector('.content') ) {
                let rowHeight = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-auto-rows'));
                let rowGap = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-row-gap'));
                let rowSpan = Math.ceil((item.querySelector('.content').getBoundingClientRect().height + rowGap) / (rowHeight + rowGap));
                item.style.gridRowEnd = 'span ' + rowSpan;
            }
        }
    },

    components: {
        FadeList
    }
}

</script>

<style lang="scss" scoped>
.insight-container {
    transition: .35s;
}
</style>



