<template>
    <div class="slideshow-container w-full flex justify-center items-center">
        <a
            href="#"
            @click.prevent="back"
            class="controls controls-prev ml-2 lg:ml-0 lg:mr-4"
        >
            ➬
        </a>
        <fade-list
            tag="div"
            class="image-container"
        >
            <img
                v-for="(image, index) in images"
                :key="image"
                :src="image"
                v-show="selected === index"
            />
        </fade-list>
        <a
            href="#"
            @click.prevent="forward"
            class="controls controls-next mr-2 lg:mr-0 lg:ml-4"
        >
            ➫
        </a>
    </div>
</template>

<script>
import { validateJSON } from '../helpers';
import { FadeList } from './transitions';


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
            selected: 0
        };
    },

    computed: {
        images: function () {
            return JSON.parse(this.itemsStr);
        }
    },

    methods: {
        back: function () {
            if (this.selected - 1 < 0) {
                this.selected = this.images.length - 1;
            } else {
                this.selected -= 1;
            }
        },

        forward: function () {
            if (this.selected + 1 > (this.images.length - 1)) {
                this.selected = 0;
            } else {
                this.selected += 1;
            }
        }
    },

    components: {
        FadeList
    }
}
</script>

<style lang="scss" scoped>
.slideshow-container {
    height: 300px;
    @media(min-width: 640px) {
        height: 500px;
    }
}

.image-container {
    max-width: 700px;
    img {
        margin: 0 auto;
    }
}

.controls-prev, .controls-next {
    font-size: 50px;
}

.controls-prev {
    transform: rotate(180deg);
}
</style>
