angular.module('newApp')
  .controller('componentsCtrl', ['$scope', 'pluginsService', function ($scope, pluginsService) {
      $scope.$on('$viewContentLoaded', function () {
          pluginsService.init();
      });
  }]);
