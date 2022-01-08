<template>
    <nav class="fixed top-0 left-0 flex flex-col">
        <a href="/">
            juliana roccoforte novello
        </a>
        <a
            v-for="(item, index) in items"
            :key="index"
            :href="item.url"
        >
            {{ item.name }}
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
}
</style>
