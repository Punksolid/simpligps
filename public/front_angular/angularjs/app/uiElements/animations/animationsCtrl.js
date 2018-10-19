"use strict";

angular.module('newApp')
  .controller('animationsCtrl', ['$scope', function ($scope) {
      $scope.$on('$viewContentLoaded', function () {

          $('.js_triggerAnimation').click(function () {
              var anim = $('.js_animations').val();
              testAnim(anim);
          });

          $('.js_animations').change(function () {
              var anim = $(this).val();
              testAnim(anim);
          });

          function testAnim(x) {
              $('#animationSandbox').removeClass().addClass(x + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                  $(this).removeClass();
              });
          };

      });
  }]);
