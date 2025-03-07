import './bootstrap';

var listings_glide = document.getElementById('amenities-carousel');

if(listings_glide){

    var listings_carousel = new Glide('#amenities-carousel', {
        type: 'carousel',
        startAt: 0,
        perView: 3,
        focusAt: 'center',
        breakpoints: {
            992: {
            perView: 1
            }
        }
    });

    listings_carousel.mount();

}