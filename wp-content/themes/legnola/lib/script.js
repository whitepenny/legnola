//=require formstone/dist/js/core.js
//=require formstone/dist/js/background.js
//=require formstone/dist/js/touch.js
//=require formstone/dist/js/checkpoint.js
//=require formstone/dist/js/mediaquery.js
//=require formstone/dist/js/navigation.js
//=require formstone/dist/js/swap.js
//=require formstone/dist/js/transition.js
//=require formstone/dist/js/carousel.js
//=require formstone/dist/js/lightbox.js
//=require formstone/dist/js/viewer.js

(function($) {

    Formstone.Ready(function() {
      $('.mobile-navigation').navigation({
        type: "overlay",
          gravity: "right",
          maxWidth: "992px",
          label: false,
          theme: '',
      });

      $('.slides').carousel({
        'infinite': true,
        'controls': true,
        
      });

      $('.lightbox').lightbox();
    });

})(jQuery);