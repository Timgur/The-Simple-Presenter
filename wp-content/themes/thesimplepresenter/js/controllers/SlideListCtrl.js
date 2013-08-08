function SlideListCtrl($scope) {
    $scope.slides = getSlides();
    $scope.orderProp = "slide_number";
    $scope.slidePos = 0;

    $scope.nextSlide = function() {
        $scope.goToSlide('next');
    };

    $scope.prevSlide = function() {
        $scope.goToSlide('prev');
    };

    $scope.goToSlide = function(action) {
       if (typeof action === "number") {
           $scope.slidePos = action;
           return;
       }

        var newSlidePos = (action === 'next') ? +1 : -1;
        if (($scope.slidePos + newSlidePos) < 0) {
            newSlidePos = $scope.slides.length;
        }

        $scope.slidePos = Math.abs(($scope.slidePos + newSlidePos) % ($scope.slides.length + 1));
    };

    $scope.toggleFullScreen = function(e) {
        $('#fullscreen').fullScreen();
    };

    $scope.showBottomBar = function() {
        console.log('hi');
    };

    $scope.keyPress = function(e) {
        switch (e.keyCode) {
            case 32:
            case 39:
            case 40:
                $scope.nextSlide();
                break;
            case 37:
            case 38:
                $scope.prevSlide();
                break;
        }
    };
};
