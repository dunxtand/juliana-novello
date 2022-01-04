import NavBar from './nav/nav_bar';
import NavMenuSmall from './nav/nav_menu_small';

import CarouselData from './carousels/carousel_data';
import CaseStudiesCarousel from './carousels/case_studies_carousel';
import FeedbackCarousel from './carousels/feedback_carousel';
import InsightsCarousel from './carousels/insights_carousel';
import TwigCarousel from './carousels/twig_carousel';
import GalleryCarousel from './carousels/gallery_carousel';
import FeaturedCaseStudies from './carousels/featured_case_studies';

import FooterContactForm from './footer/footer_contact_form';
import ScrollToTop from './footer/scroll_to_top';

import SiteButton from './global/site_button';
import AnchorLinks from './global/anchor_links';
import LottieAnimation from './global/lottie_animation';
import VideoPlayPause from './global/video_play_pause';

import ContactPageForm from './contact/contact_page_form';
import OfficeLocation from './contact/office_location';

import ExpandInsights from './insights/expand_insights';

import TeamMembers from './team/team_members';
import JobsList from './team/jobs_list';

import ProjectInfo from './case-studies/project_info'
import AwardsMarquee from './case-studies/awards_marquee';
import AnimateNumber from './case-studies/animate_number';


export default [
    ['nav-bar', NavBar],
    ['nav-menu-small', NavMenuSmall],

    ['carousel-data', CarouselData],
    ['case-studies-carousel', CaseStudiesCarousel],
    ['feedback-carousel', FeedbackCarousel],
    ['insights-carousel', InsightsCarousel],
    ['twig-carousel', TwigCarousel],
    ['gallery-carousel', GalleryCarousel],
    ['featured-case-studies', FeaturedCaseStudies],

    ['footer-contact-form', FooterContactForm],
    ['scroll-to-top', ScrollToTop],

    ['site-button', SiteButton],
    ['anchor-links', AnchorLinks],
    ['lottie-animation', LottieAnimation],
    ['video-play-pause', VideoPlayPause],

    ['contact-page-form', ContactPageForm],
    ['office-location', OfficeLocation],

    ['expand-insights', ExpandInsights],

    ['team-members', TeamMembers],
    ['jobs-list', JobsList],

    ['project-info', ProjectInfo],
    ['awards-marquee', AwardsMarquee],
    ['animate-number', AnimateNumber]
];
