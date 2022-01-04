<template>
    <div class="container py-10 flex flex-col bg-slate">

        <div class="border-t border-white py-6">
            <div>
                <p class="my-0">Our Team</p>
            </div>
        </div>

        <fade>
            <div
                class="w-full md:w-2/3 self-end relative border-b border-white"
                v-show="teamMembers.length > 0"
            >
                <div
                    v-for="teamMember in teamMembers"
                    :key="teamMember.id"
                    class="border-t border-white flex flex-col relative"
                >
                    <div
                        :class="[
                            'flex flex-row justify-between py-3 bg-slate relative',
                            { 'cursor-pointer': !!teamMember.bio }
                        ]"
                        @click="toggleSelected(teamMember)"
                        @mouseenter="selected === NONE_SELECTED ? (hovered = teamMember.id) : null"
                        @mouseleave="hovered = NONE_SELECTED"
                    >
                        <div class="flex flex-row flex-grow items-center bg-slate overflow-hidden">
                            <p class="w-1/2 lg:w-1/3 bg-slate my-0">
                                {{ teamMember.name }}
                            </p>
                            <p :class="[
                                'bg-slate w-1/2 lg:w-auto my-0',
                                { 'ml-1': !!teamMember.bio }
                            ]">
                                {{ teamMember.position }}
                            </p>
                        </div>

                        <p
                            v-if="teamMember.bio"
                            class="w-2 lg:w-4 my-0"
                        >
                            +
                        </p>
                    </div>
                    
                    <slide-down
                        transition=".35s"
                        height-zero
                    >
                        <div
                            class="w-full md:w-2/3 self-end bg-slate"
                            v-show="teamMember.id === selected"
                        >
                            <p v-html="teamMember.bio"></p>
                            <br />
                        </div>
                    </slide-down>

                    <fade>
                        <!-- lazyloading messes with the fade in / out animation of this image -->
                        <img
                            v-show="teamMember.id === selected || teamMember.id === hovered"
                            :src="teamMember.image"
                            class="hidden md:block absolute object-cover"
                        />
                    </fade>
                </div>
            </div>
        </fade>
    </div>
</template>

<script>
import { Fade, SlideDown } from '../transitions';
import { getTeamMembers } from '../../api';


const NONE_SELECTED = null;


export default {
    created: function () {
        getTeamMembers()
            .then(data => this.teamMembers = data)
            .catch(err => {
                console.error('Error fetching team members:', err);
            });
    },

    data: function () {
        return {
            selected: NONE_SELECTED,
            hovered: NONE_SELECTED,
            teamMembers: []
        };
    },

    computed: {
        NONE_SELECTED: () => NONE_SELECTED
    },

    methods: {
        toggleSelected: function ({ id, bio }) {
            if (this.selected === id) {
                this.selected = NONE_SELECTED;
            } else if (bio) {
                this.selected = id;
            }
        }
    },

    components: {
        Fade,
        SlideDown
    }
}
</script>

<style lang="scss" scoped>
img.absolute {
    left: -50%;
    width: 47%;
}

.rotate {
    transform: rotate(45deg);
}
</style>
