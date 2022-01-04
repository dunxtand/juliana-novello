<template>
    <div class="hidden"></div>
</template>

<script>
import { getCarouselData } from '../../api';
import { carouselData } from '../../store';


export default {
    props: {
        pageId: {
            type: [String, Number],
            required: true,
            validator: val => !!parseInt(val)
        }
    },

    created: function () {
        getCarouselData(this.pageId)
            .then(data => {
                carouselData.caseStudies = data.case_studies;
                carouselData.feedback = data.feedback;
                carouselData.insights = data.insights;
            })
            .catch(err => {
                console.error('Couldn\'t fetch carousel data:', err);
            });
    }
}
</script>
