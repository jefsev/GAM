(($) => {
    "use strict";

    $('#add_api_key').on('click', (e) => {
        e.preventDefault();

        const key = $('#api_key').val();
        const formArgs = {
            action: 'add_api_key',
            key: key,
        }

        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            data: formArgs,
            dataType: 'json',
            type: 'post',
            success: function () {
                location.reload(true);
            },
            error: function (e) {
                console.log('This is not good: ' + e);
            },
        });
    });

    // Setup geocoder
    const geocoder = new google.maps.Geocoder();

    // Search for correct lat lon on input change
    const address_search_bar = document.querySelector('#address_search');

    // Search while typing
    address_search_bar.addEventListener('keypress', (e) => {
        searchAddresses(e.target.value);
    })

    // Search on copy paste
    address_search_bar.addEventListener('paste', (e) => {
        let paste = (e.clipboardData || window.clipboardData).getData('text');

        searchAddresses(paste);
    })

    // Save location
    document.body.addEventListener('click', (e) => {
        if (e.target.className === 'desired-address') {
            add_address_to_list(e);
        };
    });

    function add_address_to_list(e) {
        let lat = e.target.dataset.lat;
        let lon = e.target.dataset.lon;
        let address = e.target.dataset.address;
        let company_name = e.target.querySelector('span').textContent;

        // setup array
        let data = {
            'lat': lat,
            'lon': lon,
            'address': address,
            'company': company_name
        }

        console.log(data)

        // setup unique identifier
        let key = lat + lon;

        const ajaxArgs = {
            action: 'add_address',
            obj: data,
            key: key
        }

        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            data: ajaxArgs,
            dataType: 'json',
            type: 'post',
            success: function () {
                e.target.remove();
                location.reload(true);
            },
            error: function (e) {
                console.log('This is not good: ' + e);
            },
        });
    }

    // Remove location
    const remove_location = document.querySelectorAll('.remove_address');

    remove_location.forEach(btn => {
        btn.addEventListener('click', (e) => {
            // Get unique key
            let key = e.target.dataset.key;

            // Ajax the key
            const ajaxArgsRemove = {
                action: 'remove_address',
                key: key
            }

            $.ajax({
                url: '/wp-admin/admin-ajax.php',
                data: ajaxArgsRemove,
                dataType: 'json',
                type: 'post',
                success: function () {
                    location.reload(true);
                },
                error: function (e) {
                    console.log('This is not good: ' + e);
                },
            });
        })
    });

    var service = new google.maps.places.PlacesService(document.createElement('div'));

    // Search for addresses
    function searchAddresses(inputval) {
        const sug = $('#suggestions');
        const current_sug = $('#suggestions ul li');
        let input = inputval;
        // check if e have enough input
        if (input.length > 4) {
            $('#address_search').addClass('loading');

            geocoder.geocode({ address: input }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    // Remove previous results
                    if (current_sug > 0) {
                        sug.find('ul li').remove();
                    }

                    // Add results
                    $.each(results, function (i) {
                        let lat = this.geometry.location.lat();
                        let lng = this.geometry.location.lng()
                        let pointCenter = new google.maps.LatLng(lat, lng);

                        sug.find("ul").append(
                            "<li class='desired-address' data-index='" +
                            i +
                            "' data-lat='" +
                            this.geometry.location.lat() +
                            "' data-lon='" +
                            this.geometry.location.lng() +
                            "' data-address='" +
                            this.formatted_address +
                            "'>" +
                            this.formatted_address +
                            " <span id='company_" + i + "'></span></li>"
                        );

                        var request = {
                            location: pointCenter,
                            rankBy: google.maps.places.RankBy.DISTANCE,
                            type: ['establishment'],
                        };

                        service.nearbySearch(request, function (PlaceResult, status) {
                            if (status === google.maps.places.PlacesServiceStatus.OK) {
                                let company = PlaceResult[0].name;
                                document.querySelector('#company_' + i).textContent = company;
                            }
                        });

                    });

                    // Show suggestions
                    sug.show();
                } else {
                    sug.hide();
                }

                // Remove loading icon on inactivity
                setTimeout(function () {
                    $('#address_search').removeClass("loading");
                }, 1200);
            });
        } else {
            sug.hide();
        }
    }

})(jQuery);
