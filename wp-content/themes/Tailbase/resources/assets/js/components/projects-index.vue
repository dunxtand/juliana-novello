<template>
    <div class="w-full h-full flex justify-between pt-4 pb-24">
        <img
            :src="image || 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7'"
            :class="{ show: !!selected }"
        />

        <div class="w-full h-full flex flex-col justify-between items-center mx-4">
            <a
                v-for="(project, index) in projects"
                :key="index"
                :href="project.link"
                :class="[
                    'flex mb-16 lg:mb-0',
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
import { validateJSON, preloadImage } from '../helpers';


export default {
    props: {
		itemsStr: {
			type: String,
			required: true,
			validator: validateJSON
		}
    },

    mounted: function () {
        for (const { gallery } of this.projects) {
            gallery.forEach(preloadImage);
        }
    },

    data: function () {
        return {
            selected: null,
            image: null
        };
    },

    watch: {
        selected: function (val) {
            if (!val) {
                return setTimeout(() => {
                    if (!this.selected) {
                        this.image = null;
                    }
                }, 400);
            }

            const randomIndex = Math.floor((Math.random()) * ((this.selectedProject.gallery.length - 1) + 1));
            this.image = this.selectedProject.gallery[randomIndex];
        }
    },

    computed: {
		projects: function () {
			return JSON.parse(this.itemsStr);
		},

        selectedProject: function () {
            return this.projects.find(item => item.id === this.selected) || null;
        }
    }
}
</script>

<style lang="scss" scoped>
img {
    max-width: 63%;
    max-height: 90%;
    position: absolute;
    z-index: 1;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    opacity: 0;
    transition: opacity .4s;
    &.show {
        opacity: 1;
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
        max-width: 900px;
        text-align: center;
        opacity: 1;
        transition: opacity .4s, color .1s;
    }
}

h2 {
    font-size: 45px;
    text-align: center;
}
</style>

