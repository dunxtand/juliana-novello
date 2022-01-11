<template>
    <nav class="fixed top-0 left-0 flex flex-col">
        <a href="/">
            juliana roccoforte novello
        </a>
        <a
            v-for="(item, index) in items"
            :key="index"
            :href="item.link"
            class="flex items-center my-2"
        >
            <img
                :src="item.image"
                :alt="item.title"
                @mouseover="selected = index"
                @mouseout="selected = null"
            />
            <div
                v-show="selected === index"
                class="ml-2"
            >
                {{ item.title }}
            </div>
        </a>
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
		}
    }
}
</script>

<style lang="scss" scoped>
nav {
    z-index: 100;

    img {
        width: 40px;
    }
}
</style>
