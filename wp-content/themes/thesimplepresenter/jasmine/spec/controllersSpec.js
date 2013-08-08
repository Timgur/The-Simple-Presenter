describe('Slideshow controllers', function() {
    describe('SlideListCtrl', function() {
        var scope, ctrl;

        beforeEach(function() {
            scope = {},
            ctrl = new SlideListCtrl(scope);
        });
        
        it('should create "slides" model with 4 slides - using fake data', function() {
            expect(scope.slides.length).toBe(4);
        });

        it('should set the default value of orderProp model', function() {
            expect(scope.orderProp).toBe('slide_number');
        });

        it('should set the default slide position of the controller', function() {
            expect(scope.slidePos).toBe(0);
        });

        it('should increase slidePos by one when nextSlide is called', function() {
            scope.nextSlide();
            expect(scope.slidePos).toBe(1);
        });

        it('should reset slidePos to zero if number is equal to the slides length', function() {
            scope.slidePos = 4;
            scope.nextSlide();
            expect(scope.slidePos).toBe(0);
        });

        it('should reset slidePos to last slide if number is equal to zero and previous is hit', function() {
            scope.slidePos = 0;
            scope.prevSlide();
            expect(scope.slidePos).toBe(4);
        });

        it('should decrease slidePos by one when prevSlide is called', function() {
            scope.slidePos = 1;
            scope.prevSlide();
            expect(scope.slidePos).toBe(0);
        });

        it('should update slidePos to the number passed in if it is a number', function() {
            scope.goToSlide(20);
            expect(scope.slidePos).toBe(20);
        });

        it('should increase slidePos by one when user keydowns on space bar', function() {
            var e = {keyCode:32};
            scope.keyPress(e);
            expect(scope.slidePos).toBe(1);
        });

        it('should increase slidePos by one when user keydowns on right arrow', function() {
            scope.slidePos = 3;
            var e = {keyCode:39};
            scope.keyPress(e);
            expect(scope.slidePos).toBe(4);
        });

        it('should increase slidePos by one when user keydowns on down arrow', function() {
            scope.slidePos = 3;
            var e = {keyCode:40};
            scope.keyPress(e);
            expect(scope.slidePos).toBe(4);
        });

        it('should decrease slidePos by one when user keydowns on left arrow', function() {
            scope.slidePos = 2;
            var e = {keyCode:37};
            scope.keyPress(e);
            expect(scope.slidePos).toBe(1);
        });

        it('should decrease slidePos by one when user keydowns on up arrow', function() {
            scope.slidePos = 3;
            var e = {keyCode:38};
            scope.keyPress(e);
            expect(scope.slidePos).toBe(2);
        });
    });
});
