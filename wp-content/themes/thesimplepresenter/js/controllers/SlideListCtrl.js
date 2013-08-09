function SlideListCtrl($scope) {
    $scope.slides = getSlides();
    $scope.orderProp = "slide_number";
    $scope.slidePos = 0;
    // this is to help include a default title slide
    $scope.SLIDELENGTH = $scope.slides.length + 1;

    $scope.nextSlide = function() {
        $scope.goToSlide('next');
    };

    $scope.prevSlide = function() {
        $scope.goToSlide('prev');
    };

    $scope.enterNumber = function(e) {
        if (e.keyCode === 13) {
            e.preventDefault();
            $scope.goToSlide(parseInt(e.target.innerHTML));
        }
        return false;
    };

    $scope.goToSlide = function(action) {
        if (typeof action === "number") {
            if (action != 0 && action <= $scope.SLIDELENGTH) {
                $scope.slidePos = action-1;
            }
            return;
        }

        var newSlidePos = (action === 'next') ? +1 : -1;
        if (($scope.slidePos + newSlidePos) < 0) {
            newSlidePos = $scope.slides.length;
        }

        $scope.slidePos = Math.abs(($scope.slidePos + newSlidePos) % ($scope.SLIDELENGTH));
    };

    $scope.toggleFullScreen = function() {
        $('#fullscreen').fullScreen();
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
