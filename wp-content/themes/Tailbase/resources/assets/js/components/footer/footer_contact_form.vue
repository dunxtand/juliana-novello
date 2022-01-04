<template>
    <form
        @submit="signup"
        class="py-3 m-0"
    >
        <div class="flex flex-row justify-between">
            <input
                type="text"
                placeholder="Enter your email here"
                class="p-4 focus:outline-none flex-grow mr-px"
                v-model="params.EMAIL"
                @input="clearMessages"
                @focus="clearMessages"
            />
            <a
                href="#"
                @click="signup"
                class="submit flex justify-center items-center p-4 focus:outline-none text-adjust"
            >
                {{ loading ? 'Loading...' : 'Submit' }}
            </a>
        </div>

        <div class="text-xs my-2">
            We promise to keep your information safe and private.
        </div>

        <fade>
            <p
                v-show="error || successMessage"
                :class="[
                    'absolute bottom-0 text-sm lg:text-md',
                    {
                        'text-red-500': !!error,
                        'text-green-500': !!successMessage
                    }
                ]"
            >
                <span v-html="error || successMessage"></span>
            </p>
        </fade>
    </form>
</template>

<script>
import { Fade } from '../transitions';
import isEmail from 'validator/lib/isEmail';
import fetchJsonp from 'fetch-jsonp';

const LIST_URL = 'https://agency.us15.list-manage.com/subscribe/post-json';


export default {
    data: function () {
        return {
            params: {
                u: 'c75550625d9827daf5e2defbf',
                id: '9c58a7ff1d',
                EMAIL: ''
            },
            error: null,
            successMessage: null,
            loading: false
        };
    },

    computed: {
        reqURL: function () {
            return LIST_URL + '?' + Object.entries(this.params)
                .map(entry => entry.join('='))
                .join('&');
        }
    },

    methods: {
        clearMessages: function () {
            this.error = null;
            this.successMessage = null;
        },

        signup: function (e) {
            e.preventDefault();

            if (this.loading) {
                return;
            }
            
            if (!isEmail(this.params.EMAIL)) {
                this.error = 'Please enter a valid email.';
                return;
            }

            this.loading = true;

            fetchJsonp(this.reqURL, {
                jsonpCallback: 'c',
                cache: 'no-store',
                mode: 'no-cors',
                headers: {
                    'content-type': 'application/json; charset=utf-8'
                }
            })
                .then(response => {
                    this.loading = false;

                    if (response.ok) {
                        return response.json();
                    }
                    throw new Error(response.statusText);
                })
                .then(responseJson => {
                    if (responseJson.result === 'error') {
                        this.error = responseJson.msg;
                        
                    } else if (responseJson.result === 'success') {
                        this.successMessage = responseJson.msg;

                    } else {
                        this.error = 'Something went wrong. Try again?';
                    }
                })
                .catch(err => {
                    this.loading = false;
                    this.error = 'Something went wrong. Try again?';
                    console.error(err);
                });
        }
    },

    components: {
        Fade
    }
}
</script>

<style lang="scss" scoped>
a, input {
    height: 50px;

    &[type='text'] {
        background-color: #958F86;
        min-width: auto;
        color: #464440;
        @media (min-width: 1280px) {
            min-width: 73%;
        }
        &::placeholder {
            color: #464440;
        }
    }

    &.submit {
        background-color: transparent;
        border: 2px solid #fff;
        border-radius: 40px;
        margin-left: 10px;
        padding: 10 20px;
        @media (min-width: 1280px) {
            margin-left: 20px;
        }
    }
}

p {
    transition: .1s;
}
</style>
