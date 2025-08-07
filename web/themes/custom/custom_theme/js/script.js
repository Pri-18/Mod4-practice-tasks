(function ($, Drupal) {
  Drupal.behaviors.customThemeBehavior = {
    attach: function (context, settings) {
      console.log('My Bootstrap subtheme JS loaded!');
    }
  };
})(jQuery, Drupal);
