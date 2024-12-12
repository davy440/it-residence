// Custom JS for Theme
jQuery(document).ready(function() {
    const body  = document.querySelector('body');
    
    function toggleNavMenu() {
        const subMenu = this.nextElementSibling;
        const expanded = this.getAttribute('aria-expanded') === 'true' ? 'false' : 'true';
        this.setAttribute('aria-expanded', expanded);
        subMenu.classList.toggle('is-visible');
    }

    const mobileNav = () => {
        const
        navBtn      = body.querySelector('.mobile-nav-btn'),
        mobileNav   = body.querySelector('.panel'),
        navClose    = mobileNav.querySelector('#close-menu'),
        goToBottom  = mobileNav.querySelector('.go-to-bottom'),
        goToTop     = mobileNav.querySelector('.go-to-top'),
        dropdowns   = mobileNav.querySelectorAll('span'),
        links       = mobileNav.getElementsByTagName('a');

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
            if (links.length === 0) {
                return;
            }
            const lastLink = links[links.length - 1];
            lastLink.focus();
        });

        goToTop.addEventListener('focus', () => {
            if (links.length === 0) {
                return;
            }
            navClose.focus();
        });

        // Accessing sub-menus
        dropdowns.forEach(arrow => {
            arrow.addEventListener('click', toggleNavMenu);
            arrow.addEventListener('keydown', function(e) {
                if (['Space', 'Enter'].includes(e.code)) {
                    toggleNavMenu.call(this);
                }
            });
        });
    }
    mobileNav();

    //Fade In/Out for Go to Top Button
    const topBtn = document.getElementById( 'itre-back-to-top' );

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
                return;
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
            count++;
        }


        const fadeOut = element => {

            if ( count < 1 ) {
                return;
            }

            let opacity = 1
            setTimeout( () => { element.style.display = "none" }, 200)
            var timer = setInterval( function() {

                if ( opacity <= 0.001 ) {
                    clearInterval( timer )
                }

                element.style.opacity = opacity;
                element.style.filter = 'alpha(opacity=' - opacity * 100 + ")";
                opacity -= opacity * 0.1;
            })
            count--;
        }

        topBtn.addEventListener('click', (e) => {
          e.preventDefault();
          window.scrollTo({top: 0, left: 0, behavior: 'smooth'});
        });
    }

    // Lightbox feature for Gallery block
    const Lightbox = () => {
        const selector = document.querySelector('.is-style-lightbox a');

        if (!selector) {
            return;
        }
        
        const lightbox = GLightbox({
            selector: '.is-style-lightbox a',
            touchNavigation: true,
            keyboardNavigation: true,
            width: "auto",
            height: "auto",
            draggable: false,
        });
    }
    Lightbox();
});
