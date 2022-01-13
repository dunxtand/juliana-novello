<template>
    <div class="w-full h-screen flex justify-between py-4">
        <img
            :src="previewImage || 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7'"
            :class="{ show: !!previewImage && !!selected }"
        />

        <div class="w-full h-full flex flex-col justify-between items-center">
            <a
                v-for="(project, index) in items"
                :key="index"
                :href="project.link"
                :class="[
                    'flex text-right my-10',
                    {
                        selected: selected === project.id,
                        'not-selected': !!selected && selected !== project.id
                    }
                ]"
                @mouseenter="selected = project.id"
                @mouseleave="selected = null"
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
img {
    max-width: 90%;
    max-height: 90%;
    position: absolute;
    z-index: 1;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    opacity: 0;
    transition: .4s;
    &.show {
        opacity: 0.8;
    }
}

a {
    z-index: 10;
    &.selected {
        h2 {
            color: #ccf4f9;
        }
    }

    &.not-selected {
        h2 {
            opacity: 0;
        }
    }

    h2 {
        font-size: 45px;
        text-align: center;
        opacity: 1;
        transition: .4s;
    }
}

h2 {
    font-size: 45px;
    text-align: center;
}
</style>

