$(function () {
    $('#js-news').ticker(
        {speed: 0.10,           // The speed of the reveal
        ajaxFeed: false,       // Populate jQuery News Ticker via a feed                           // MUST BE ON THE SAME DOMAIN AS THE TICKER                           // SHOULD BE SET TO FALSE FOR PRODUCTION SITES!
        controls: false,        // Whether or not to show the jQuery News Ticker controls
        titleText: 'اخبار',   // To remove the title set this to an empty String
        displayType: 'reveal', // Animation type - current options are 'reveal' or 'fade'
        direction: 'rtl',       // Ticker direction - current options are 'ltr' or 'rtl'
        pauseOnItems: 2000,    // The pause on a news item before being replaced
        fadeInSpeed: 600,      // Speed of fade in animation
        fadeOutSpeed: 300      // Speed of fade out animation
    }
    );
});         
