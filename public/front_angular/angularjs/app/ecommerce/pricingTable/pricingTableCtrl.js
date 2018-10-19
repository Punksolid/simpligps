'use strict';

angular.module('newApp')
  .controller('pricingTableCtrl', function ($scope, pricingTableService) {
      $scope.$on('$viewContentLoaded', function () {
          pricingTableService.init();
      });
  });
