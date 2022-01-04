<template>
    <div class="anchor-links">
        <slot />
    </div>
</template>

<script>
import { navbar } from '../../store';


export default {
    mounted: function () {
        this.stickyContainer.style.transition = '.4s';

        this.changeTopVal(0);

        // wait 1s so offsetTop is correct
        setTimeout(() => {
            // create these here in 'mounted' so we can access this.$el
            this.sections = Array.from(this.$el.querySelectorAll('a'))
                .map(anchor => ({
                    anchor,
                    position: document.querySelector(anchor.hash).offsetTop,
                    shown: false
                }));
        }, 1000);

        window.addEventListener('scroll', () => {
            for (const section of this.sections) {
                // scrolling down
                if (!section.shown && window.scrollY > section.position) {
                    const newTopVal = -(this.getCurrentTop() + this.getAnchorHeight(section.anchor));
                    this.changeTopVal(newTopVal);
                    section.shown = true;

                // scrolling up
                } else if (section.shown && window.scrollY < section.position) {
                    const newTopVal = -(this.getCurrentTop() - this.getAnchorHeight(section.anchor));
                    this.changeTopVal(newTopVal);
                    section.shown = false;
                }
            }
        });
    },

    data: function () {
        return {
            sections: []
        };
    },

    computed: {
        navbarVisible: () => navbar.show,

        stickyContainer: function () {
            return this.$el.parentElement;
        }
    },

    watch: {
        navbarVisible: function (val) {
            this.stickyContainer.style.top = val ? '6rem' : '0'; // height of <nav> element
        }
    },

    methods: {
        changeTopVal: function (val) {
            this.$el.style.top = `${val}px`;
        },

        getCurrentTop: function () {
            return Math.abs(parseInt(this.$el.style.top));
        },

        getAnchorHeight: function (anchor) {
            return anchor.getBoundingClientRect().height;
        }
    }
}
</script>

<style lang="scss">
.anchor-links {
    transition: .35s;
    color: #958F86;

    a svg {
        top: 0;
        right: 1px;
    }

    a span, a svg, a svg path {
        transition: .35s;
    }

    a:hover {
        span {
            color: black;
        }

        svg {
            top: 10px;

            path {
                stroke: black;
            }
        }

        &.text-white {
            span {
                color: #958F86;
            }

            path {
                stroke: #958F86;
            }
        }
    }
}
</style>
