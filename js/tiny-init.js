document.addEventListener('DOMContentLoaded', function () {
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