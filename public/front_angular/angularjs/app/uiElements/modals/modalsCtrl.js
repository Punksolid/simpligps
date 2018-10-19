angular.module('newApp')
  .controller('modalsCtrl', function ($scope) {
      $scope.$on('$viewContentLoaded', function () {
          $('.colors-list li').click(function () {
              var self = $(this);
              var portlet_header = self.parent().parent().parent().prev();
              var portlet_footer = self.parent().parent().parent().next();
              var portlet_full = self.parent().parent().parent().parent();
              if (!self.hasClass('active')) {
                  self.siblings().removeClass('active');
                  if (self.parent().hasClass('color-footer')) {
                      var classes = portlet_footer.attr('class').split(/\s+/);
                  }
                  if (self.parent().hasClass('color-header')) {
                      var classes = portlet_header.attr('class').split(/\s+/);
                  }
                  if (self.parent().hasClass('color-full')) {
                      var classes = portlet_full.attr('class').split(/\s+/);
                  }
                  var pattern = /^bg-/;
                  for (var i = 0; i < classes.length; i++) {
                      var className = classes[i];
                      if (className.match(pattern)) {
                          if (self.parent().hasClass('color-footer')) portlet_footer.removeClass(className);
                          if (self.parent().hasClass('color-header')) portlet_header.removeClass(className);
                          if (self.parent().hasClass('color-full')) portlet_full.removeClass(className);
                      }
                  }
                  var color = self.attr('class');
                  bg_color = 'bg-' + color;
                  if (self.parent().hasClass('color-footer')) portlet_footer.addClass(bg_color);
                  if (self.parent().hasClass('color-header')) portlet_header.addClass(bg_color);
                  if (self.parent().hasClass('color-full')) portlet_full.addClass(bg_color);
                  self.addClass('active');
              };
          });

      });
      

  });
