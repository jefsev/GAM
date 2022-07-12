
<?php
/*
 * View for GAM settings page
*/
$api_key = get_option( 'g_key' );
?>

<div class="GAM-setting-page">
    <header class='GAM-header'>
        <span>Google Addresses Settings</span>
    </header>

    <div class="GAM-settings-content">

            <form method="post" id="gam-api-key-form">
                
                <input type="text" name="api_key" id="api_key" value="">
                <button class="button-primary btn--ajax" id="add_api_key">add api key</button>
            </form>

        <div class="fields">
        <label for="meta-text" class="prfx-row-title">Vul de adressen van alle locaties in:</label>
        <div class="address_meta_box_row">
            <div class="humaninput">
                <input type="text" name="addresses[]" class="address" id="address_search" autocomplete="off" style="width: 100%" value="" />
                <div class="suggestions">
                    <ul></ul>
                </div>
            </div>
            <div class="close"></div>
            <input type="hidden" name="latlon[]" class="latlon" value="" />
            <div style="clear:both"></div>
        </div>
        </div>
        <div class="addone">
            <a href="#" class="add">Extra locatie toevoegen</a>
        </div>
    </div>
</div>