
angular.module('newApp')
.directive('ngViewClass', function ($location) {
    return {
        link: function (scope, element, attrs, controllers) {
            var classes = attrs.ngViewClass ? attrs.ngViewClass.replace(/ /g, '').split(',') : [];
            setTimeout(function () {
                if ($(element).hasClass('ng-enter')) {
                    for (var i = 0; i < classes.length; i++) {
                        var route = classes[i].split(':')[1];
                        var newclass = classes[i].split(':')[0];

                        if (route === $location.path()) {
                            $(element).addClass(newclass);
                        } else {
                            $(element).removeClass(newclass);
                        }
                    }
                }
            })

        }
    };
});

