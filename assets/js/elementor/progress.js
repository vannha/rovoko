(function ($) {
    var RovokoWidgetTeamHandler = function ($scope, $) {
        var $progress = $scope.find('.rovoko-progress-bar').eq(0);
        if ($progress.length > 0) {
            $progress.elementorWaypoint(function (direction) {
                $progress.css('width', $progress.data('max') + '%');
            }, {offset: '100%'});
        }
    };
    // Make sure we run this code under Elementor
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/rovoko_progress.default', RovokoWidgetTeamHandler);
    });
})(jQuery);