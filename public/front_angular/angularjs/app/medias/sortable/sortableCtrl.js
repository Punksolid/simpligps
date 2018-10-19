'use strict';

angular.module('newApp')
  .controller('sortableCtrl', ['$scope', function ($scope) {
      $scope.$on('$viewContentLoaded', function () {
          var $container = $('.portfolioContainer');
          $container.isotope();
          $('.portfolioFilter a').click(function () {
              $('.portfolioFilter .current').removeClass('current');
              $(this).addClass('current');
              var selector = $(this).attr('data-filter');
              $container.isotope({
                  filter: selector
              });
              return false;
          });
      });
  }]);
