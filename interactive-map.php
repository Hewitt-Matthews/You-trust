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
            <img src="<?= esc_url($map_image['url']) ?>" alt="<?= esc_attr($map_image['alt']) ?>" class="map-svg">
            <div class="map-highlight-overlay"></div>
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

    .interactive-map__info-box {
        position: absolute;
        top: 20px;
        left: 20px;
        width: 300px; /* Adjust as needed */
        background-color: white;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 4px;
        z-index: 20;
        display: none; /* Hide by default */
        opacity: 0; /* Start with 0 opacity for fade-in effect */
        transition: opacity 0.3s ease; /* Smooth transition for fade-in/out */
    }

    .info-box-close {
        position: absolute;
        top: 10px;
        right: 10px;
        background: none;
        border: none;
        font-size: 24px;
        line-height: 1;
        cursor: pointer;
        padding: 0;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #888;
        transition: color 0.3s ease;
    }

    .info-box-close:hover {
        color: #333;
    }

    .interactive-map__container {
        position: relative;
        width: 100%;
        height: 0;
        padding-bottom: 56.25%; /* Adjust this value based on your map's aspect ratio */
    }

    .interactive-map__container img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .map-highlight-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 0, 0.3); /* Semi-transparent yellow */
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
    }

    .map-pin {
        position: absolute;
        transform: translate(-50%, -50%);
        z-index: 10;
    }

    .map-pin__marker {
        width: 24px;
        height: 24px;
        cursor: pointer;
        color: red; /* Change this to adjust the pin color */
        filter: drop-shadow(0 0 2px rgba(0,0,0,0.5)); /* Add a shadow effect */
    }

    .map-pin__marker svg {
        width: 100%;
        height: 100%;
    }

    .map-pin__info {
        display: none; /* Hide the original info boxes */
    }

    .map-svg path {
        transition: fill 0.3s ease;
    }

    .map-svg .highlighted {
        fill: rgba(255, 255, 0, 0.3); /* Semi-transparent yellow, adjust as needed */
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mapPins = document.querySelectorAll('.map-pin');
    const infoBox = document.getElementById('mapInfoBox');
    const mapSvg = document.querySelector('.map-svg');
    const mapContainer = document.querySelector('.interactive-map__container');
    
    mapPins.forEach(pin => {
        pin.addEventListener('click', (e) => {
            e.stopPropagation();
            const info = pin.querySelector('.map-pin__info').innerHTML;
            infoBox.innerHTML = info;
            showInfoBox();
        });

        pin.addEventListener('mouseenter', () => {
            const region = pin.dataset.region;
            highlightRegion(region);
        });

        pin.addEventListener('mouseleave', () => {
            resetHighlight();
        });
    });

    mapContainer.addEventListener('click', () => {
        hideInfoBox();
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

    function highlightRegion(region) {
        const regionElement = mapSvg.querySelector(`#${region}`);
        if (regionElement) {
            regionElement.classList.add('highlighted');
        }
    }

    function resetHighlight() {
        const highlightedRegions = mapSvg.querySelectorAll('.highlighted');
        highlightedRegions.forEach(region => {
            region.classList.remove('highlighted');
        });
    }

    const closeIcon = document.createElement('button');
    closeIcon.innerHTML = '&times;';
    closeIcon.classList.add('info-box-close');
    closeIcon.addEventListener('click', hideInfoBox);
    infoBox.appendChild(closeIcon);
});
</script>
