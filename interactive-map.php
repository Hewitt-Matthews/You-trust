<?php
// Get data from ACF options page
$map_image = get_field('map_svg_url', 'option');

// Get all map locations
$locations = get_posts(array(
    'post_type' => 'map_location',
    'posts_per_page' => -1,
));

if ($map_image) : ?>

<div class="interactive-map section section--spaced">
    <div class="wrapper">
        <div class="interactive-map__container">
            <img src="<?= esc_url($map_image['url']) ?>" alt="<?= esc_attr($map_image['alt']) ?>" class="map-image">
            <div class="map-overlay"></div>
            <div class="interactive-map__info-box" id="mapInfoBox">
                <!-- Info will be dynamically inserted here -->
            </div>
            <?php 
            foreach ($locations as $location) :
                $pins = get_field('map_pins', $location->ID);
                if ($pins && is_array($pins)) :
                    foreach ($pins as $pin) :
            ?>
            <div class="map-pin" 
                 data-location="<?= esc_attr($pin['pin_label']) ?>" 
                 data-region="<?= esc_attr($pin['region_value']) ?>"
                 style="left:<?= esc_attr($pin['x_coordinate']) ?>%; top: <?= esc_attr($pin['y_coordinate']) ?>%;">
                <div class="map-pin__marker">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="24" height="24">
                        <path fill="currentColor" d="M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z"/>
                    </svg>
                </div>
                <div class="map-pin__info">
                    <h3><?= esc_html($pin['pin_label']) ?></h3>
                    <p><?= esc_html($pin['pin_description']) ?></p>
                    <?php if ($pin['button_text'] && $pin['button_url']) : ?>
                        <a href="<?= esc_url($pin['button_url']) ?>" class="button"><?= esc_html($pin['button_text']) ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <?php 
                    endforeach;
                endif;
            endforeach; 
            ?>
        </div>
    </div>
</div>

<?php endif; ?>

<style>
    .interactive-map__content {
        display: flex;
        align-items: flex-start;
        gap: 20px;
    }

    .interactive-map__container {
        position: relative;
        width: 100%;
        height: 0;
        padding-bottom: 56.25%; /* Adjust based on your image aspect ratio */
    }

    .map-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .map-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4); /* This is equivalent to #00000066 */
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
        z-index: 15;
    }

    .interactive-map__info-box {
        position: absolute;
        top: 20px;
        left: 20px;
        width: 300px;
        background-color: white;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 4px;
        z-index: 20;
        display: none;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .map-pin {
        position: absolute;
        transform: translate(-50%, -100%);
        cursor: pointer;
        z-index: 10;
    }

    .map-pin__marker {
        width: 24px;
        height: 24px;
        color: #ff0000; /* Adjust pin color as needed */
    }

    .map-pin__info {
        display: none;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mapPins = document.querySelectorAll('.map-pin');
    const infoBox = document.getElementById('mapInfoBox');
    const mapContainer = document.querySelector('.interactive-map__container');
    const mapOverlay = document.querySelector('.map-overlay');
    
    mapPins.forEach(pin => {
        pin.addEventListener('click', (e) => {
            e.stopPropagation();
            const info = pin.querySelector('.map-pin__info').innerHTML;
            infoBox.innerHTML = info;
            showInfoBox();
            showOverlay();
        });
    });

    mapContainer.addEventListener('click', () => {
        hideInfoBox();
        hideOverlay();
    });

    infoBox.addEventListener('click', (e) => {
        e.stopPropagation();
    });

    function showInfoBox() {
        infoBox.style.display = 'block';
        setTimeout(() => {
            infoBox.style.opacity = '1';
        }, 10);
    }

    function hideInfoBox() {
        infoBox.style.opacity = '0';
        setTimeout(() => {
            infoBox.style.display = 'none';
        }, 300);
    }

    function showOverlay() {
        mapOverlay.style.visibility = 'visible';
        mapOverlay.style.opacity = '1';
    }

    function hideOverlay() {
        mapOverlay.style.opacity = '0';
        setTimeout(() => {
            mapOverlay.style.visibility = 'hidden';
        }, 300);
    }
});
</script>