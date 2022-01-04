<script>
export default {
    mounted: function () {
        this.$watch('$refs.carousel.dragging', dragging => this.dragging = dragging);
    },

    data: function () {
        return {
            dragging: false,
            slideIndex: 0
        };
    },

    computed: {
        dragStyle: function () {
            return {
                cursor: this.dragging ? 'grabbing' : 'grab'
            };
        }
    },

    methods: {
        showOverflow: function () {
            // force elements off the current page to be visible
            if (this.$el && this.$el.getElementsByClassName) {
                this.$el.getElementsByClassName('VueCarousel-wrapper')[0].style.overflow = 'visible';
            }
        },

        navigate: function (index) {
            if (index < 0) {
                this.slideIndex = this.slides.length - 1;
            } else if (index > this.slides.length - 1) {
                this.slideIndex = 0;
            } else {
                this.slideIndex = index;
            }
        }
    }
}
</script>

<style lang="scss">
.VueCarousel-dot {
    transition: .35s;
}
</style>
