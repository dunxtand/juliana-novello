<template>
    <div>
        <svg
            @click="open = !open"
            class="z-20 fixed lg:hidden overflow-visible"
            width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg"
        >
            <g filter="url(#dropshadow)">
            <ellipse cx="40" cy="36" rx="36" ry="36" :fill="bgColor"/>
            <path d="M26.1642 8.20784C27.9333 7.27363 29.7824 8.00397 30.6011 9.55497C31.4197 11.106 30.9859 13.0441 29.2168 13.9783L27.7215 14.768L28.8914 16.9822L27.0449 17.9603L22.8198 9.97562L26.1642 8.20784ZM28.7416 10.5382C28.3542 9.80788 27.5097 9.42335 26.7324 9.83368L25.4644 10.5021L26.9261 13.2634L28.1941 12.595C28.9715 12.1847 29.129 11.2686 28.7416 10.5382Z" :fill="textColor"/>
            <path d="M37.2357 5.02325C39.2242 4.80905 40.6705 6.17166 40.859 7.91621C40.9959 9.18592 40.4613 10.3601 39.3869 11.0079L41.4891 13.6505L39.0744 13.9112L37.215 11.5937L36.2388 11.6995L36.5074 14.1873L34.4284 14.4118L33.46 5.431L37.2357 5.02325ZM38.7542 8.14073C38.6664 7.32007 38.0233 6.64909 37.1479 6.74458L35.7223 6.89684L36.058 10.0014L37.4836 9.84916C38.3565 9.75367 38.8446 8.96398 38.7542 8.14073Z" :fill="textColor"/>
            <path d="M43.6998 9.21431C44.4668 6.85814 46.866 5.25036 49.7249 6.18199C52.5735 7.10846 53.5652 9.82078 52.7956 12.1744C52.0285 14.5306 49.6293 16.1383 46.7808 15.2119C43.9219 14.2802 42.9328 11.5705 43.6998 9.21431ZM50.7708 11.5163C51.2305 10.1047 50.714 8.48398 49.1412 7.973C47.5685 7.46202 46.1971 8.46591 45.7374 9.87755C45.2777 11.2892 45.7942 12.9099 47.367 13.4209C48.9398 13.9318 50.3111 12.9254 50.7708 11.5163Z" :fill="textColor"/>
            <path d="M54.1023 19.2971C52.4624 17.8597 52.589 16.0325 53.8338 14.6157L55.4065 15.9938C54.8203 16.6622 54.6757 17.4132 55.2877 17.95C55.8998 18.4868 56.5842 18.3319 57.2246 17.6042L61.1321 13.1525L62.6945 14.5228L58.7845 18.9745C57.3641 20.5926 55.6648 20.6675 54.1023 19.2971Z" :fill="textColor"/>
            <path d="M63.4383 21.9114L65.1092 24.8947L63.6784 25.6947L62.0075 22.7114L60.272 23.6817L61.943 26.665L60.4786 27.4831L57.785 22.6778L65.6722 18.2648L68.3658 23.0727L66.9015 23.8908L65.2305 20.9075L63.4383 21.9114Z" :fill="textColor"/>
            <path d="M61.5298 33.3671C61.176 30.3425 63.1697 28.2908 65.6981 27.9941C68.1463 27.7076 70.6127 29.2121 70.9562 32.1464C71.2841 34.9413 69.794 36.6471 67.7744 37.1581L67.5214 34.9929C68.5492 34.6652 69.2517 33.7774 69.1019 32.4948C68.8979 30.7528 67.4232 29.9373 65.9486 30.1102C64.3706 30.296 63.2085 31.4703 63.4203 33.2638C63.5391 34.2755 64.3371 35.091 65.2487 35.2329L65.507 37.4368C63.5545 37.313 61.8216 35.842 61.5298 33.3671Z" :fill="textColor"/>
            <path d="M68.9856 39.8808L70.7366 40.3272L69.2077 46.317L67.4567 45.8706L67.9629 43.8834L60.9564 42.0976L61.4729 40.0717L68.4794 41.8576L68.9856 39.8808Z" :fill="textColor"/>
            <path d="M32.3727 65.5406L34.3354 56.7224L36.4015 57.1817L34.4387 65.9974L32.3727 65.5406Z" :fill="textColor"/>
            <path d="M23.202 61.5121L21.4045 60.4695L25.9369 52.6552L27.8248 53.7494L27.7266 60.4024L30.6398 55.3778L32.4501 56.4256L27.9177 64.24L26.0299 63.1457L26.1564 56.4178L23.202 61.5121Z" :fill="textColor"/>
            <path d="M19.6355 52.7326L17.5023 50.059L18.8452 48.988L20.9784 51.6616L23.4215 49.7158L24.7257 51.3493L17.6572 56.9804L14.2198 52.6732L15.5938 51.579L17.727 54.2526L19.6355 52.7326Z" :fill="textColor"/>
            <path d="M16.0768 47.4396C13.6905 48.1106 11.0201 47.0112 10.204 44.1156C9.39309 41.233 11.0976 38.9052 13.4864 38.2342C15.8727 37.5632 18.5431 38.6626 19.354 41.5453C20.1675 44.4408 18.463 46.7686 16.0768 47.4396ZM14.0624 40.2859C12.6316 40.6885 11.5728 42.0175 12.0196 43.6072C12.4663 45.197 14.0649 45.7802 15.4957 45.3776C16.9264 44.975 17.9853 43.6459 17.5385 42.0562C17.0917 40.4665 15.4931 39.8833 14.0624 40.2859Z" :fill="textColor"/>
            <line x1="39.469" y1="29" x2="39.469" y2="42.4" :stroke="textColor" stroke-width="2"/>
            <line x1="46.4" y1="35.469" x2="33" y2="35.469" :stroke="textColor" stroke-width="2"/>
            </g>
            <defs>            
            <filter id="dropshadow" x="0" y="0" width="80" height="80" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
            <feFlood flood-opacity="0" result="BackgroundImageFix"/>
            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
            <feOffset dy="4"/>
            <feGaussianBlur stdDeviation="2"/>
            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
            <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow"/>
            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"/>
            </filter>
            </defs>
        </svg>

        <transition name="fade">
            <div
                v-show="open"
                class="project-info fixed top-0 left-0 z-10 visible lg:hidden w-full h-full overflow-y-scroll"
            >
                <slot />
            </div>
        </transition>
    </div>
</template>

<script>
const OPEN_LINK_CLASS = 'open-project-info-sm';
const CLOSE_LINK_CLASS = 'close-project-info-sm';


export default {
    mounted: function () {
        for (const link of document.getElementsByClassName(OPEN_LINK_CLASS)) {
            link.onclick = e => {
                e.preventDefault();
                this.open = true;
            };
        }

        for (const link of document.getElementsByClassName(CLOSE_LINK_CLASS)) {
            link.onclick = e => {
                e.preventDefault();
                this.open = false;
            };
        }
    },

    data: function () {
        return {
            open: false
        };
    },

    computed: {
        textColor: function () {
            return this.open ? 'white' : 'black';
        },

        bgColor: function () {
            return this.open ? '#0066FF' : 'white';
        }
    },

    watch: {
        open: function (val) {
            document.body.style.overflow = val ? 'hidden' : '';
        }
    }
}
</script>

<style lang="scss" scoped>
svg {
    transition: .15s;
    bottom: 64px;
    left: calc(10% - 34px);
}

nav, ul {
    background-color: #464440;
}

.fade-enter-active, .fade-leave-active {
    transition: opacity 0.15s;
}
.fade-enter, .fade-leave-to {
    opacity: 0;
}
</style>
