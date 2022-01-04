<script>
import { Carousel, Slide } from 'vue-carousel';
import { validateJSON } from '../../helpers';
import { screens } from '../../../../../build/tailwind.config';


export default {
    props: {
        itemsstr: {
            type: String,
            validator: validateJSON,
            default: '[]'
        }
    },

    computed: {
        items: function () {
            return JSON.parse(this.itemsstr);
        },

        screens: function () {
            return {
                sm: parseInt(screens.sm),
                md: parseInt(screens.md),
                lg: parseInt(screens.lg),
                xl: parseInt(screens.xl)
            };
        }
    },

    components: {
        Carousel,
        Slide
    }
}
</script>