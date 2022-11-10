<template>
    <nav>
        <div class="fixed top-0 left-0 ml-2 lg:ml-8 mt-2 lg:mt-6">
            <a href="/">
                <h3 class="nabla">
                    juliana roccoforte novello
                </h3>
            </a>
        </div>

        <div class="fixed bottom-0 lg:top-0 lg:right-0 lg:bottom-auto flex w-full lg:w-auto justify-center items-center mb-2 lg:mb-0 lg:mr-2 lg:mt-2">
            <div
                v-show="!!tooltip"
                class="tooltip mr-2 text-nuclear"
            >
                {{ tooltip }}
            </div>
            <a
                v-for="(item, index) in items"
                :key="index"
                :href="item.link"
                class="flex items-center mx-4"
            >
                <img
                    :src="item.image"
                    :alt="item.title"
                    @mouseover="selectedIndex = index"
                    @mouseout="selectedIndex = null"
                />
            </a>
        </div>
    </nav>
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
            selectedIndex: null,
            tooltip: null
        };
    },

    watch: {
        selectedIndex: function (index) {
            if (window.innerWidth < 1024) {
                this.tooltip = null;
            } else {
                this.tooltip = (this.items[this.selectedIndex] || { title: null }).title
            }
        }
    },

    computed: {
		items: function () {
			return JSON.parse(this.itemsStr);
		}
    }
}
</script>

<style lang="scss" scoped>
nav {
    position: relative;
    z-index: 100;

    img {
        width: 40px;
    }
}
</style>
