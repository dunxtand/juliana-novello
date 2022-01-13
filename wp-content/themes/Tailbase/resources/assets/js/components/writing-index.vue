<template>
    <div class="w-full min-h-screen flex flex-col justify-between items-center mb-32">
        <a
            v-for="(post, index) in posts"
            :key="index"
            :href="post.link"
            @mouseenter="selectedIndex = index"
            @mouseleave="selectedIndex = null"
            :class="[
                'relative flex justify-center mb-6',
                {
                    selected: selectedIndex === index,
                    'not-selected': selectedIndex !== null && selectedIndex !== index
                }
            ]"
        >
            <h2 class="text-center">
                {{ post.title }}
            </h2>
            <div
                v-if="selectedIndex === index"
                v-html="selectedContent"
                class="selected-content"
            ></div>
        </a>
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
            selectedIndex: null,
            selectedContent: '',
            timeouts: []
        };
    },

    watch: {
        selectedPost: function (post) {
            if (post) {
                let letters = post.content
                    .split('')
                    .map(letter => {
                        if (letter === '\n' || letter === '\r') {
                            return '<br>';
                        }
                        return letter;
                    })
                    .filter((letter, index, arr) => {
                        if (letter !== '<br>') {
                            return true;
                        }
                        return arr[index + 1] !== letter;
                    });
                
                if (letters[0] === '<br>') {
                    letters = letters.slice(1);
                }

                const timeouts = letters.map((letter, index) => {
                    return setTimeout(() => {
                        this.selectedContent += letter;
                    }, index * 45);
                });
                this.timeouts = timeouts;
            } else {
                this.selectedContent = '';
                this.timeouts.forEach(timeoutID => clearTimeout(timeoutID));
                this.timeouts = [];
            }
        }
    },

    computed: {
        posts: function () {
			return JSON.parse(this.itemsStr);
		},

        selectedPost: function () {
            return this.posts[this.selectedIndex] || null;
        }
    }
}
</script>

<style lang="scss" scoped>
a {
    h2 {
        font-size: 45px;
        transition: opacity .4s, color .3s;
    }

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
}

.selected-content {
    width: 500px;
    position: absolute;
    top: 100px;
    margin: 0 auto;
    /* left: 0;
    right: 0; */
}
</style>
