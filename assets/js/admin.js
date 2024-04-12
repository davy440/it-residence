// JS for Admin area

(function() {

    const noticeCookie = () => {
        const notice = document.querySelector('.itre-notice');

        if (!notice) {
            return;
        }

        const dismissBtn = notice.querySelector('.notice-dismiss');
        console.log(dismissBtn);
    }
    
    

    window.onload = () => {
        // noticeCookie();
    }
})();