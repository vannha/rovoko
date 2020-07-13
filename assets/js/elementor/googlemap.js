(function ($) {
    "use strict";
    var RovokoWidgetTeamHandler = function ($scope, $) {
        var $maps = $scope.find('.map-render').eq(0);
        if ($maps.length > 0) {
            /* map type */
            var map_type;
            switch ($maps.data('type')) {
                case 'HYBRID':
                    map_type = google.maps.MapTypeId.HYBRID;
                    break;
                case 'SATELLITE':
                    map_type = google.maps.MapTypeId.SATELLITE;
                    break;
                case 'TERRAIN':
                    map_type = google.maps.MapTypeId.TERRAIN;
                    break;
                default:
                    map_type = google.maps.MapTypeId.ROADMAP;
                    break;
            }

            /* get controls */
            var controls = $.parseJSON(decodeURIComponent($maps.data('controls')));

            /* get style */
            var style;
            if (controls.style == 'custom') {
                style = $.parseJSON(decodeURIComponent($maps.data('template')));
            } else {
                style = $.parseJSON(decodeURIComponent($maps.data('template')));
            }

            var mapOptions = {
                zoom: parseInt($maps.data('zoom')),
                center: new google.maps.LatLng(37.9723128, -122.53077),
                mapTypeId: map_type,
                scrollwheel: controls.scrollwheel,
                panControl: controls.pancontrol,
                zoomControl: controls.zoomcontrol,
                scaleControl: controls.scalecontrol,
                mapTypeControl: controls.maptypecontrol,
                streetViewControl: controls.streetviewcontrol,
                overviewMapControl: controls.overviewmapcontrol,
                styles: style
            }
            var map = new google.maps.Map($maps.get(0),
                mapOptions);

            /* map center */
            if ($maps.data('coordinate').length > 0) {
                var coordinate = $maps.data('coordinate').split(',');
                if (coordinate.length == 2) {
                    map.setCenter(new google.maps.LatLng(coordinate[0], coordinate[1]));
                }
            } else {
                if ($maps.data('address').length > 0) {
                    $.getJSON('http://maps.google.com/maps/api/geocode/json?address=' + $maps.data('address') + '', function (data) {
                        var lat = data.results[0].geometry.location.lat;
                        var lng = data.results[0].geometry.location.lng;
                        map.setCenter(new google.maps.LatLng(lat, lng));
                    });
                }
            }
            /* marker */
            var locations = $.parseJSON(decodeURIComponent($maps.data('marker')));
            //console.log(locations.markerlist);
            if (locations.markerlist != undefined) {
                if (Array.isArray(locations.markerlist)) {
                    for (var i = 0; i < locations.markerlist.length; i++) {
                        if (locations.markerlist[i].markertitle != '' || locations.markerlist[i].markerdesc != '')
                            locations.markerdesc = '<div class="info-content"><h5>'
                                + locations.markerlist[i].markertitle
                                + '</h5><span>'
                                + locations.markerlist[i].markerdesc
                                + '</span></div>';
                        locations.markercoordinate = locations.markerlist[i].markercoordinate;
                        locations.markericon = locations.markerlist[i].markericon.url;
                        markerRender(map, locations);
                    }
                }
            }
            //markerRender(map, '"markercoordinate":"37.9608114,-122.5065692","icon":"","markertitle":"Construction Center","markerdesc":"');
            /* */
            function markerRender(map, locations) {
                "use strict";
                var location = locations.markercoordinate.split(',');
                if (location.length == 2) {
                    var myLatLng = new google.maps.LatLng(
                        location[0], location[1]
                    );

                    var mk = {
                        position: myLatLng,
                        map: map,
                        //icon: 'images/marker.png'
                    }

                    if (locations.markericon != false) {
                        mk.icon = locations.markericon;
                    }

                    var marker = new google.maps.Marker(mk);
                    marker.setMap(map);
                    if (locations.markerdesc != undefined) {
                        var infowindow = new google.maps.InfoWindow(
                            {
                                content: locations.markerdesc,
                                maxWidth: controls.infowidth,
                                borderRadius: 0,
                            });
                        infowindow.open(map, marker);
                    }
                }
            }
        }
    };

    // Make sure we run this code under Elementor
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/rovoko_googlemap.default', RovokoWidgetTeamHandler);
    });
})(jQuery);