<template>
    <form
        @submit="send"
        class="lg:-mx-4 px-6"
    >
        <fade-list
            tag="div"
            class="min-h-screen flex flex-col justify-center items-center w-full pt-4"
        >
            <div
                v-for="(field, index) in fields"
                :key="field.id"
                :class="[
                    'w-full relative flex flex-col items-center',
                    {
                        'w-full': field.type !== TEXTAREA,
                        'w-full lg:mx-5': field.type === TEXTAREA,
                    }
                ]"
            >
                <form-field
                    :field="field"
                    :class="[
                        'w-full p-2 border-b border-r border-l border-black bg-transparent',
                        { 'border-t': index === 0 }
                    ]"
                />
            </div>

            <div
                v-show="loaded"
                :key="'submit'"
                class="w-full flex flex-row justify-center mt-4"
            >
                <button
                    @click="send"
                    color="white"
                >
                    {{ submitting ? 'please wait...' : 'submit' }}
                </button>
            </div>

            <div
                v-show="message || error"
                :key="'message'"
                class="w-full flex flex-row justify-center my-6"
            >
                {{ message || error }}
            </div>
        </fade-list>
    </form>
</template>

<script>
import { getContactForm, addContactFormEntry } from '../../api';
import FormField, { TEXTAREA } from './form-field';
import { FadeList } from '../transitions';


export default {
    props: {
        pageId: {
            type: [String, Number],
            required: true,
            validator: val => !!parseInt(val)
        }
    },

    created: function () {
        getContactForm(this.pageId)
            .then(form => {
                this.fields = form.fields.map(field => ({
                    id: field.id,
                    type: field.type,
                    label: field.label,
                    placeholder: field.placeholder,
                    isRequired: field.isRequired,
                    errorMessage: field.errorMessage,
                    value: '',
                    touched: false,
                    valid: !field.isRequired
                }));
                this.$nextTick(() => this.loaded = true);
            })
            .catch(err => {
                console.error('Error retrieving form:', err);
            });
    },

    data: function () {
        return {
            fields: [],
            loaded: false,
            submitting: false,
            message: '',
            error: ''
        };
    },

    computed: {
        TEXTAREA: () => TEXTAREA,

        hasErrors: function () {
            return this.fields.some(f => !f.valid);
        }
    },

    methods: {
        send: function (e) {
            e.preventDefault();

            if (this.submitting) {
                return false;
            }

            if (this.hasErrors) {
                for (const field of this.fields) {
                    field.touched = true;
                }
                return;
            }

            const reqData = this.fields.reduce((data, field) => ({ ...data, [field.id]: field.value }), {});

            this.submitting = true;

            addContactFormEntry(this.pageId, reqData)
                .then(() => {
                    this.fields = this.fields.map(f => ({ ...f, value: '' }));
                    this.$nextTick(() => this.fields = this.fields.map(f => ({ ...f, touched: false })));
                    this.submitting = false;
                    this.message = 'thanks for reaching out! I\'ll be in touch as soon as possible.';
                    this.error = '';
                })
                .catch(err => {
                    console.error('Error submitting form:', err);
                    this.submitting = false;
                    this.error = 'something went wrong - please try again later.';
                    this.message = '';
                });
        }
    },

    components: {
        FormField,
        FadeList
    }
}
</script>

<style lang="scss" scoped>
form {
    min-height: 50%;
    max-width: 700px;
    margin-left: auto;
    margin-right: auto;
}

input, textarea {
    -webkit-appearance: none;
    &::placeholder {
        color: #958F86;
    }
}

textarea {
    height: 200px;
}

input, textarea, button {
    outline: none !important;
}
</style>
