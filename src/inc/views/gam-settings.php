
<?php
/*
 * View for GAM settings page
*/
$api_key = get_option( 'g_key' );
$saved_addresses = get_option( 'gam_selected_addresses ');
?>

<div class="GAM-setting-page">
    <header class='GAM-header'>
        <span>Google Addresses Settings</span>
    </header>

    <div class="GAM-settings-content">
            <div class="info">
                <h2>Google API Key</h2>
                <p>Create a google API key at: <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">Google documentation</a></p>
            </div>
            <form method="post" id="gam-api-key-form">
                <?php if (!empty($api_key)) { ?>
                    <input type="text" name="api_key" id="api_key" value="" placeholder="*******************" style="padding-top: 7px;"><span class="dashicons dashicons-saved"></span>
                <?php } else { ?>
                    <input type="text" name="api_key" id="api_key" value="">
                <?php } ?>
                <button class="button-primary btn--ajax" id="add_api_key">Add key</button>
            </form>

        <div class="search-container">
            <h3 class="gam-row-title">Find address:</h3>
            <p>Find address by typing.</p>
            <div class="address_meta_box_row">
                <div class="humaninput">
                    <input type="text" name="addresses[]" class="address" id="address_search" autocomplete="off" style="width: 100%" value="" />
                    <div class="suggestions" id="suggestions">
                        <ul></ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="saved-locations" id="saved_locations">
            <?php foreach ($saved_addresses as $address) { ?>
                <div class="saved-location">
                    <h4><?php if (!empty($address["company"])) { echo '<b>'. $address["company"] .'</b> -'; }  ?> <?= $address["address"]; ?></h4>
                    <button class='button-secondary remove_address' data-key='<?= $address["lat"] . $address["lon"] ?>'>Remove location</button>
                </div>
            <?php } ?>
        </div>
    </div>
</div>