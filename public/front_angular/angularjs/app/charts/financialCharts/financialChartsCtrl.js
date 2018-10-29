'use strict';

/**
 * @ngdoc function
 * @name newappApp.controller:AboutCtrl
 * @description
 * # financialChartsCtrl
 * Controller of the newappApp
 */
angular.module('newApp')
  .controller('financialChartsCtrl', function (chartFinanceService, $scope) {
      $scope.$on('$viewContentLoaded', function () {
          chartFinanceService.init();
      });
  });
