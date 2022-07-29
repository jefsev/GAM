
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
                <?php if ($api_key) { ?>
                    <input type="text" name="api_key" id="api_key" value="" disabled placeholder="*******************" style="padding-top: 7px;"><span class="dashicons dashicons-saved"></span>
                    <button class="button-primary btn--ajax" id="add_api_key">Remove key</button>
                <?php } else { ?>
                    <input type="text" name="api_key" id="api_key" value="">
                    <button class="button-primary btn--ajax" id="add_api_key">Add key</button>
                <?php } ?>
                
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
            <h3 class="gam-row-title">Update address information:</h3>
            <p>Add information for the google map marker infowindow.</p>
            <?php foreach ($saved_addresses as $address) { ?>
                <div class="saved-location">
                    <div class="head">
                        <h4><?php if (!empty($address["company"])) { echo '<b>'. $address["company"] .'</b> -'; }  ?> <?= $address["address"]; ?></h4>
                        <div class="btn-row">
                            <button class='button-secondary remove_address' data-key='<?= $address["lat"] . $address["lon"] ?>'>Remove location</button>
                            <button class='button-primary update_address' data-key='<?= $address["lat"] . $address["lon"] ?>'>Update location</button>
                        </div>
                    </div>
                    <div class="extra-fields">
                        <div class="row">
                            <label for="company_name">Company name: </label>
                            <input type="text" name="company_name" id="company_name" style="width: 100%" value="" />
                        </div>
                        <div class="row">
                            <label for="company_website">Website: </label>
                            <input type="text" name="company_website" id="company_website" style="width: 100%" value="" />
                        </div>
                        <div class="row">
                            <label for="phone_nr">Phone: </label>
                            <input type="text" name="phone_nr" id="phone_nr" style="width: 100%" value="" />
                        </div>
                        <div class="row">
                            <label for="email_email">Email: </label>
                            <input type="text" name="email_email" id="email_email" style="width: 100%" value="" />
                        </div>
                    </div>
                    
                </div>
            <?php } ?>
        </div>
    </div>
</div>