'use strict';

angular.module('newApp')
  .controller('wizardCtrl', ['$scope', 'pluginsService', function ($scope, pluginsService) {
      $scope.$on('$viewContentLoaded', function () {
          setTimeout(function () {
              pluginsService.init();

              $('.form-wizard-style a').click(function (e) {
                  $('.form-wizard-style a').removeClass('current');
                  $(this).addClass('current');
                  var style = $(this).attr('id');
                  e.preventDefault();
                  $('.wizard-div').removeClass('current');
                  $('.wizard-' + style).addClass('current');
              });

              $('.form-wizard-nav a').click(function (e) {
                  $('.form-wizard-nav a').removeClass('current');
                  $(this).addClass('current');
                  var style = $(this).attr('id');
                  e.preventDefault();
                  $('.wizard-div').removeClass('current');
                  $('.wizard-' + style).addClass('current');
              });

              $('.page-wizard .nav-tabs > li > a').on('click', function () {
                  $('.page-wizard .tab-pane.active a:first').not('.sf-btn').trigger('click');
                  /* Fix issue only with tabs, demo purpose */
                  setTimeout(function () {
                      $(window).resize();
                      $(window).trigger('resize');
                  }, 0);
              });

          }, 2);
      });

  }]);
