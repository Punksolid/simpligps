'use strict';

angular.module('newApp')
  .controller('mailSendCtrl', ['$scope', 'mailBoxService', function ($scope, mailBoxService) {
      $scope.$on('$viewContentLoaded', function () {
          mailBoxService.initSend();
      });
  }]);
