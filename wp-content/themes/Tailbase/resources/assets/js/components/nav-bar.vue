<template>
    <nav>
        <div class="fixed top-0 left-0 m-4">
            <a href="/">
                <h3>
                    juliana roccoforte novello
                </h3>
            </a>
        </div>

        <div class="fixed top-0 right-0 flex items-center m-3">
            <div
                v-show="!!selectedItem"
                class="mr-2"
            >
                {{ selectedItem.title }}
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
                    @mouseover="selected = index"
                    @mouseout="selected = null"
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
            selected: null
        };
    },

    computed: {
		items: function () {
			return JSON.parse(this.itemsStr);
		},

        selectedItem: function () {
            return this.items[this.selected] || {};
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
