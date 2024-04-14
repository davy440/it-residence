// Custom JS for Theme
jQuery(document).ready(function() {
    
    const testSlider = () => {

        const testimonials = document.querySelector('.testimonials-wrapper');

        if (testimonials === null) {
            return;
        }

        jQuery('.testimonials-wrapper').owlCarousel({
            items: 2,
            autoplay: true,
            dots: true,
            loop: true,
            responsive:
            {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                }
            }
        });
    }

    testSlider();

    const toggleNavMenu = (item) => {
        item.classList.toggle('is-visible');
    }

    const mobileNav = () => {
        const body = document.querySelector('body');
        const navBtn = document.querySelector('.mobile-nav-btn');
        const mobileNav = document.querySelector('.panel');
        const navClose = mobileNav.querySelector('#close-menu');
        const goToBottom = mobileNav.querySelector('.go-to-bottom');
        const goToTop = mobileNav.querySelector('.go-to-top');
        const dropdowns = mobileNav.querySelectorAll('span');

        navBtn.addEventListener('click', () => {
            mobileNav.classList.add('expanded');
            navBtn.setAttribute('aria-expanded', true);
            mobileNav.setAttribute('aria-hidden', false);
            body.classList.add('no-scroll');
            navClose.focus();
        });

        document.addEventListener('click', (e) => {
            if (!mobileNav.contains(e.target) && !navBtn.contains(e.target) && mobileNav.classList.contains('expanded')) {
                mobileNav.classList.remove('expanded');
                navBtn.setAttribute('aria-expanded', false);
                mobileNav.setAttribute('aria-hidden', true);
                body.classList.remove('no-scroll');
                navBtn.focus();
            }
        });

        navClose.addEventListener('click', () => {
            mobileNav.classList.remove('expanded');
            navBtn.setAttribute('aria-expanded', false);
            mobileNav.setAttribute('aria-hidden', true);
            body.classList.remove('no-scroll');
            navBtn.focus();
        });

        goToBottom.addEventListener('focus', () => {
            document.querySelector('ul#menu-mobile li:last-child > a').focus();
        });

        goToTop.addEventListener('focus', () => {
            navClose.focus();
        });

        // Accessing sub-menus
        dropdowns.forEach(dropdown => {
            const subMenu = dropdown.nextElementSibling;
            dropdown.addEventListener('click', () => toggleNavMenu(subMenu));
            dropdown.addEventListener('keydown', (e) => {
                if (['Space', 'Enter'].includes(e.code)) {
                    toggleNavMenu(subMenu);
                }
            });
        });
    }
    mobileNav();

    //Fade In/Out for Go to Top Button
    const topBtn = document.querySelector( '#itre-back-to-top' );

    if ( topBtn !== null ) {

        var count = 0
        window.onscroll = () => {
            if ( window.scrollY > 300 ) {
                fadeIn( topBtn )
            } else {
                fadeOut( topBtn )
            }
        }

        const fadeIn = element => {

            if ( count > 0 ) {
                return
            }
            var opacity = 0.1
            element.style.display = "flex"

            var timer = setInterval( function() {

                if ( opacity >= 1 ) {
                    clearInterval( timer )
                }

                element.style.opacity = opacity;
                element.style.filter = 'alpha(opacity=' + opacity * 100 + ")";
                opacity += opacity * 0.1;
            })
            count++
        }


        const fadeOut = element => {

            if ( count < 1 ) {
                return
            }

            var opacity = 1
            setTimeout( () => { element.style.display = "none" }, 200)
            var timer = setInterval( function() {

                if ( opacity <= 0.001 ) {
                    clearInterval( timer )
                }

                element.style.opacity = opacity;
                element.style.filter = 'alpha(opacity=' - opacity * 100 + ")";
                opacity -= opacity * 0.1;
            })
            count--
        }

        topBtn.addEventListener('click', function(e) {
          e.preventDefault();
          jQuery('html').animate({scrollTop:0}, 300, 'linear');
        });
    }

    // Lightbox feature for Gallery block
    const lightbox = GLightbox({
        selector: '.is-style-lightbox a',
        height: 'auto',
        touchNavigation: false,
        keyboardNavigation: false,
        width: 'auto',
        draggable: false,
    });
});
