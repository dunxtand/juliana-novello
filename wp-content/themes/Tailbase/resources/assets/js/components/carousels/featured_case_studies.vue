<template>
    <div>
        <carousel
            :per-page="1"
            :per-page-custom="perPageCustom"
            :pagination-enabled="true"
            ref="carousel"
        >
            <slot/>
        </carousel>
    </div>
</template>

<script>
import CarouselBase from './carousel_base';
import { BREAKPOINT_MD, BREAKPOINT_LG } from '../../constants';


export default {
   extends: CarouselBase,

   computed: {
       perPageCustom: () => ([
           [BREAKPOINT_MD, 2],
           [BREAKPOINT_LG, 3]
       ])
   }
}
</script>
