<template>
    <input
        v-if="field.type !== TEXTAREA"
        :type="field.type"
        :placeholder="field.placeholder"
        v-model="field.value"
    />
    <textarea
        v-else-if="field.type === TEXTAREA"
        :placeholder="field.placeholder"
        v-model="field.value"
    ></textarea>
</template>

<script>
import isEmail from 'validator/lib/isEmail';

export const TEXT = 'text';
export const EMAIL = 'email';
export const TEXTAREA = 'textarea';


export default {
    props: {
        field: {
            type: Object,
            required: true
        }
    },
    computed: {
        TEXTAREA: () => TEXTAREA
    },
    watch: {
        'field.value': function (val) {
            this.field.touched = this.field.touched || true;
            if (!this.field.isRequired) {
                return;
            }
            switch (this.field.type) {
                case TEXT:
                case TEXTAREA:
                    this.field.valid = !!val.trim();
                    break;
                case EMAIL:
                    this.field.valid = !!isEmail(val);
                    break;
            }
        }
    }
}
</script>
