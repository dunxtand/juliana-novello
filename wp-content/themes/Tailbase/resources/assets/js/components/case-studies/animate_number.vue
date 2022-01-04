<template>
    <div v-observe-visibility="visibilityChanged">
        <animated-number
            v-if="visible"
            :value="number"
            :round="round"
            :duration="duration"
            :format-value="formatValue"
        />
    </div>
</template>

<script>
import AnimatedNumber from 'animated-number-vue';


export default {
    props: {
        value: {
            type: [String, Number],
            required: true
        }
    },

    data: function () {
        return {
            round: 1,
            duration: 1500,
            visible: false
        }
    },

    computed: {
        number: function () {
            return parseFloat(String(this.value).replace(/[^0-9.]/g, ''));
        },

        nonNumericChars: function () {
            return String(this.value).replace(/,|\./g, '').match(/(\D+)?\d+(\D+)?/) || [];
        },

        nonNumericBefore: function () {
            return this.nonNumericChars[1] || '';
        },

        nonNumericAfter: function () {
            return this.nonNumericChars[2] || '';
        }
    },

    methods: {
        formatValue: function (value) {
            return this.nonNumericBefore + value.toLocaleString() + this.nonNumericAfter;
        },

        visibilityChanged: function (isVisible) {
            if (!this.visible) {
                this.visible = isVisible;
            }
        }
    },

    components: {
        AnimatedNumber
    }
}
</script>
