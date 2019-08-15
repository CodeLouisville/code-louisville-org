<section id="map"></section>

@push('scripts')

    <script src="https://maps.google.com/maps/api/js?key=AIzaSyAKPd802_bQJmAIr3vdQ-Xl8EfvitiYbbk"></script>
    <script>
        var geocoder = new google.maps.Geocoder(),
        address = "727 W. Chestnut Street, Louisville, KY 40203",
            color = "#6181b6",
            latitude,
            longitude;

        function getGeocode() {
            geocoder.geocode( { 'address': address}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    latitude = results[0].geometry.location.lat();
                    longitude = results[0].geometry.location.lng();
                    initGoogleMap();
                }
            });
        }

        function initGoogleMap() {
            var styles = [ { stylers: [ { saturation: -100 } ] } ];
                options = {
                    mapTypeControlOptions: { mapTypeIds: ['Styled'] },
                    center: new google.maps.LatLng(latitude, longitude),
                    zoom: 13,
                    scrollwheel: false,
                    navigationControl: false,
                    mapTypeControl: false,
                    zoomControl: true,
                    disableDefaultUI: true,
                    mapTypeId: 'Styled'
                },
                div = document.getElementById('map'),
                map = new google.maps.Map(div, options);

            marker = new google.maps.Marker({
                map:map,
                draggable:false,
                animation:google.maps.Animation.DROP,
                position:new google.maps.LatLng(latitude,longitude)
            });

            var styledMapType = new google.maps.StyledMapType(styles, { name: 'Styled' });

            map.mapTypes.set('Styled', styledMapType);

            var infowindow = new google.maps.InfoWindow({ content: "<div class='iwContent'>"+address+"</div>" });

            google.maps.event.addListener(marker, 'click', function() { infowindow.open(map,marker); });

            bounds = new google.maps.LatLngBounds(
                new google.maps.LatLng(-84.999999, -179.999999),
                new google.maps.LatLng(84.999999, 179.999999)
            );

            rect = new google.maps.Rectangle({
                bounds: bounds,
                fillColor: color,
                fillOpacity: 0.2,
                strokeWeight: 0,
                map: map
            });
        }

        google.maps.event.addDomListener(window, 'load', getGeocode);
    </script>

@endpush
