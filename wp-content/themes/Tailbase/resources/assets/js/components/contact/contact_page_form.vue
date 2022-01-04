<template>
    <form
        @submit="send"
        class="lg:-mx-4"
    >
        <fade-list
            tag="div"
            class="flex flex-row flex-wrap justify-between w-full"
        >
            <div
                v-for="field in fields"
                :key="field.id"
                :class="[
                    'mb-2 pb-8 relative flex flex-col items-center',
                    {
                        'w-full lg:w-1/3': field.type !== TEXTAREA,
                        'w-full lg:mx-5 mt-2': field.type === TEXTAREA
                    }
                ]"
            >
                <form-field
                    :field="field"
                    :class="[
                        {
                            'w-full lg:w-11/12 bg-slate py-2 border-white border-b-2': field.type !== TEXTAREA,
                            'w-full bg-white p-4 text-stone': field.type === TEXTAREA
                        }
                    ]"
                />
                <field-error
                    :field="field"
                    :class="[
                        'text-red-600 absolute left-0 bottom-0',
                        { 'lg:ml-4': field.type !== TEXTAREA }
                    ]"
                />
            </div>

            <div
                v-show="loaded"
                :key="'submit'"
                class="w-full flex flex-row justify-center"
            >
                <site-button
                    @click.native="send"
                    color="white"
                >
                    {{ submitting ? 'Please wait...' : 'Submit' }}
                </site-button>
            </div>

            <div
                v-if="message || error"
                :key="'message'"
                class="w-full flex flex-row justify-center my-6"
            >
                <span :class="[
                    'text-xl',
                    {
                        'text-green-500': message,
                        'text-red-600': error
                    }
                ]">
                    {{ message || error }}
                </span>
            </div>
        </fade-list>
    </form>
</template>

<script>
import { getContactForm, addContactFormEntry } from '../../api';
import FormField, { TEXTAREA } from './form_field';
import FieldError from './field_error';
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
                    this.message = 'Thanks for reaching out! We\'ll be in touch as soon as possible.';
                    this.error = '';
                })
                .catch(err => {
                    console.error('Error submitting form:', err);
                    this.submitting = false;
                    this.error = 'Something went wrong. Please try again later.';
                    this.message = '';
                });
        }
    },

    components: {
        FormField,
        FieldError,
        FadeList
    }
}
</script>

<style lang="scss" scoped>
form {
    min-height: 50%;
}

input, textarea {
    &::placeholder {
        color: #958F86;
    }
}

textarea {
    height: 200px;
}
</style>
