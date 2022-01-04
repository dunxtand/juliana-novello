<template>
    <div class="flex flex-col bg-slate">
        <fade>
            <div
                class="w-full relative border-b border-white bg-slate"
                v-show="jobs.length > 0"
            >
                <div
                    v-for="job in jobs"
                    :key="job.id"
                    class="border-t border-white flex flex-col relative bg-slate"
                >
                    <a
                        href="#"
                        class="flex flex-row justify-between items-start pt-3 pb-8 bg-slate relative"
                        @click.prevent="toggleSelected(job)"
                    >
                        <div class="flex flex-row flex-grow bg-slate overflow-hidden">
                            <div class="w-3/4 bg-slate my-0 text-2xl bg-slate">
                                {{ job.title }}
                            </div>
                        </div>

                        <svg
                            :class="{
                                'not-selected': selected !== job.title,
                                'selected': selected === job.title   
                            }"
                            width="35" height="35" viewBox="0 0 59 59" fill="none" xmlns="http://www.w3.org/2000/svg"
                        >
                            <line x1="30" y1="15" x2="30" y2="45" stroke-width="2"/>
                            <line x1="45" y1="30" x2="15" y2="30" stroke-width="2"/>
                            <circle cx="29.5" cy="29.5" r="28.5" stroke-width="2"/>
                        </svg>
                    </a>
                    
                    <slide-down
                        transition=".35s"
                        height-zero
                    >
                        <div
                            v-show="job.title === selected"
                            class="w-full flex flex-col lg:flex-row lg:flex-wrap"
                        >
                            <div class="w-full md:w-2/3 lg:pr-20 pb-4">
                                <div class="text-stone pb-2">Description</div>
                                <div v-html="job.description"></div>
                            </div>
                            <div class="w-full md:w-1/3 flex flex-col flex-shrink-0">
                                <div class="pb-6">
                                    <div class="text-stone pb-2">Location</div>
                                    <div>{{ job.location }}</div>
                                </div>
                                <div class="pb-6">
                                    <div class="text-stone pb-2">Report</div>
                                    <div>{{ job.report }}</div>
                                </div>
                                <div class="pb-6">
                                    <div class="text-stone pb-2">Salary/Rate</div>
                                    <div>{{ job.compensation }}</div>
                                </div>
                            </div>
                            <div class="w-full flex justify-center lg:justify-start pb-10 lg:pb-20">
                                <site-button :href="job.link" color="white" new-tab>
                                    Apply to this job
                                </site-button>
                            </div>
                        </div>
                    </slide-down>
                </div>
            </div>
        </fade>
    </div>
</template>

<script>
import { Fade, SlideDown } from '../transitions';
import SiteButton from '../global/site_button';
import { getJobs } from '../../api';


const NONE_SELECTED = null;


export default {
    created: function () {
        getJobs()
            .then(data => this.jobs = data)
            .catch(err => {
                console.error('Error fetching jobs:', err);
            });
    },

    data: function () {
        return {
            selected: NONE_SELECTED,
            jobs: []
        };
    },

    methods: {
        toggleSelected: function ({ title }) {
            if (this.selected === title) {
                this.selected = NONE_SELECTED;
            } else {
                this.selected = title;
            }
        }
    },

    components: {
        Fade,
        SlideDown,
        SiteButton
    }
}
</script>

<style lang="scss" scoped>
svg {
    transition: transform .35s;

    line, circle {
        transition: stroke .35s;
    }

    &.not-selected {
        line, circle {
            stroke: #14FF00;
        }
    }

    &.selected {
        transform: rotate(45deg);

        line, circle {
            stroke: #FF0000;
        }
    }
}
</style>
