angular.module('newApp')
  .controller('portletsCtrl', ['$scope', 'pluginsService', function ($scope, pluginsService) {

      $scope.$on('$viewContentLoaded', function () {

          // Demo Script Only
          //   prettyPrint();
          $('.colors-list li').click(function () {
              var self = $(this);
              var portlet_header = self.parent().parent().parent().prev();
              var portlet_footer = self.parent().parent().parent().next();
              if (!self.hasClass('active')) {
                  self.siblings().removeClass('active');

                  if (self.parent().hasClass('color-footer')) {
                      var classes = portlet_footer.attr('class').split(/\s+/);

                  }
                  else {
                      var classes = portlet_header.attr('class').split(/\s+/);
                  }
                  var pattern = /^bg-/;
                  for (var i = 0; i < classes.length; i++) {
                      var className = classes[i];
                      if (className.match(pattern)) {
                          if (self.parent().hasClass('color-footer'))
                              portlet_footer.removeClass(className);
                          else
                              portlet_header.removeClass(className);
                      }
                  }
                  var color = self.attr('class');
                  header_color = 'bg-' + color;
                  if (self.parent().hasClass('color-footer'))
                      portlet_footer.addClass(header_color);
                  else
                      portlet_header.addClass(header_color);
                  self.addClass('active');
              };
          });

          pluginsService.init();
      });


  }]);
