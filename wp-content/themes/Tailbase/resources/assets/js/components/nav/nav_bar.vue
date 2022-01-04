<template>
	<nav
		:class="[
			'nav-bar h-24 text-black hidden lg:flex flex-row justify-between z-10 fixed top-0 w-full',
            transparent && atTop ? 'bg-transparent text-white' : 'bg-white text-black',
			{
				'shadow-md': !atTop,
				'fold-up': !show
			}
		]"
	>
        <div class="container-fluid flex justify-between lg:pl-8 lg:pr-10">
            <div class="flex" data-sal="slide-down" data-sal-duration="1000">
                <a
                    href="/"
                    :class="[
                        'flex',
                        { 'logo-at-top': transparent && atTop }   
                    ]"
                >
                    <slot name="logo" />
                
                </a>
            </div>
            <ul class="flex flex-row">
                <nav-menu-item
                    v-for="(item, index) in items"
                    :key="index"
                    v-bind="item"
                    :bar-color="transparent && atTop ? 'white' : 'black'"
                />
            </ul>
        </div>
	</nav>
</template>

<script>
import NavMenuItem from './nav_menu_item';
import { validateJSON } from '../../helpers';
import { navbar } from '../../store';


export default {
    props: {
		itemsStr: {
			type: String,
			required: true,
			validator: validateJSON
		},
        transparent: {
            type: Boolean,
            default: false
        }
    },

    created: function () {
        window.addEventListener('scroll', this.handleScroll);
        this.prevScrollPos = this.getScrollPos();
    },

    data: function () {
        return {
            show: true,
            didScroll: false,
            delta: 50,
            lastScrollTop: 0,
            prevScrollPos: 0,
            atTop: document.documentElement.scrollTop === 0
        };
    },

	computed: {
		items: function () {
			return JSON.parse(this.itemsStr);
		}
    },
    
    watch: {
        show: function (val) {
            navbar.show = val;
        },

        didScroll: function (val) {
            if (val) {
                this.hasScrolled();
                this.didScroll = false;
            }
        }
    },

    methods: {
        handleScroll: function () {
            this.prevScrollPos = this.getScrollPos();
            this.didScroll = true;
            this.atTop = document.documentElement.scrollTop === 0;
        },

        hasScrolled: function () {
            const st = this.getScrollPos();

            if (Math.abs(this.lastScrollTop - st) <= this.delta) {
                return;
            }

            const isAtTop = this.prevScrollPos < 175 || this.prevScrollPos === 0;
            const isScrollingDown = st > this.lastScrollTop && st > this.$el.clientHeight;

            this.show = isAtTop || !isScrollingDown;
            this.lastScrollTop = st;
        },

        getScrollPos: function () {
            return Math.max(window.pageYOffset, document.documentElement.scrollTop, document.body.scrollTop);
        }
    },

    components: {
        NavMenuItem
    }
}
</script>

<style lang="scss">
nav {
	transition: transform .4s, box-shadow .2s, background-color .4s, color .4s;

  	&.fold-up {
		transform: translateY(-105%); // 105% to hide drop shadow
  	}
}

.nav-logo {
	transition: transform .25s;

	&:hover {
		transform: scale(1.075);
	}
}

svg.nav-logo path {
    transition: fill .4s;
}

.logo-at-top svg.nav-logo path {
    fill: #fff;
}
</style>
