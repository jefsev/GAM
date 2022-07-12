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
    let geocoder;
    geocoder = new google.maps.Geocoder();

    // Copy the input field
    $("#GAM-search-address .addone a.add").click(function (e) {
        e.preventDefault();
        var row = $("#GAM-search-address .fields .address_meta_box_row")
            .first()
            .clone();

        $("#GAM-search-address .fields").append(row);
        var row = $("#GAM-search-address .fields .address_meta_box_row")
            .last()
            .find("input")
            .val("");
    });

    // Search for correct lat lon on input change
    $('#address_search').on("keypress", (e) => {
        searchAddresses(e.target.value);
    });

    // Add click event to li
    $(document).on(
        "click",
        "#GAM-search-address .fields .address_meta_box_row .humaninput .suggestions ul li",
        function () {
            $(
                "#GAM-search-address .fields .address_meta_box_row .humaninput .suggestions"
            ).hide();

            $(this)
                .closest(".address_meta_box_row")
                .find("input.address")
                .val($(this).text());
            $(this)
                .closest(".address_meta_box_row")
                .find("input.latlon")
                .val($(this).attr("data-lat") + ";" + $(this).attr("data-lon"));
        }
    );

    // Add click event to .close
    $(document).on(
        "click",
        "#GAM-search-address .fields .address_meta_box_row .close",
        function () {
            if ($("#GAM-search-address .fields .address_meta_box_row").length > 1)
                $(this)
                    .closest(".address_meta_box_row")
                    .remove();
        }
    );

    // Search for addresses
    function searchAddresses(inputval) {
        var sug = $(".suggestions");
        var input = inputval;
        // check if e have enough input
        if (input.length > 4) {
            $(this)
                .closest(".address_meta_box_row")
                .addClass("loading");

            geocoder.geocode({ address: input }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    // Remove previous results
                    sug.find("ul li").remove();

                    // Add results
                    $.each(results, function (i) {
                        console.log(
                            this.geometry.location.lat(),
                            this.geometry.location.lng()
                        );
                        sug
                            .find("ul")
                            .append(
                                "<li data-index='" +
                                i +
                                "' data-lat='" +
                                this.geometry.location.lat() +
                                "' data-lon='" +
                                this.geometry.location.lng() +
                                "'>" +
                                this.formatted_address +
                                "</li>"
                            );
                    });

                    // Show suggestions
                    sug.show();
                } else {
                    sug.hide();
                }

                $(this)
                    .closest(".address_meta_box_row")
                    .removeClass("loading");
            });
        } else {
            sug.hide();
        }
    }

})(jQuery);
