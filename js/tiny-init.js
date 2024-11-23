document.addEventListener('DOMContentLoaded', function () {
    const site2Sliders = document.querySelectorAll('.wp_s2_site_profile-top-side');
    site2Sliders.forEach((sliderContainer) => {
        const controlsContainer = sliderContainer
            .closest('.wp_s2_site_profile-grid-item')
            .querySelector('.wp_s2_site_tns-controls');
        tns({
            container: sliderContainer,
            items: 1,
            slideBy: 'page',
            controls: true,
            controlsContainer: controlsContainer,
            nav: false,
            loop: false,
            autoplay: false,
        });
    });

    const sliders = document.querySelectorAll('.profile-top-side');
    sliders.forEach((sliderContainer) => {
        const controlsContainer = sliderContainer
            .closest('.profile-grid-item')
            .querySelector('.tns-controls');
        tns({
            container: sliderContainer,
            items: 1,
            slideBy: 'page',
            controls: true,
            controlsContainer: controlsContainer,
            nav: false,
            loop: false,
            autoplay: false,
        });
    });
});