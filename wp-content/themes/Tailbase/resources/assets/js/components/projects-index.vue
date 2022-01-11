<template>
    <div class="w-full flex justify-between">
        <div class="w-1/2">
            <img
                v-show="!!previewImage"
                :src="previewImage"
            />
        </div>

        <div class="w-1/2 flex flex-col">
            <a
                v-for="(project, index) in items"
                :key="index"
                :href="project.link"
                class="text-right my-10"
                @mouseover="selected = project.id"
                @mouseout="selected = null"
            >
                <h2>
                    {{ project.title }}
                </h2>
            </a>
        </div>
    </div>
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

        selectedProject: function () {
            return this.items.find(item => item.id === this.selected) || null;
        },

        previewImage: function () {
            if (!this.selected) {
                return null;
            }

            const randomIndex = Math.floor((Math.random()) * ((this.selectedProject.gallery.length - 1) + 1));
            return this.selectedProject.gallery[randomIndex];
        }
    }
}
</script>

<style lang="scss" scoped>

</style>

