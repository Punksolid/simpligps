'use strict';

angular.module('newApp')
  .controller('mailboxCtrl', ['$scope', 'mailBoxService', function ($scope, mailBoxService) {
      $scope.$on('$viewContentLoaded', function () {
          mailBoxService.init();
      });
  }]);
