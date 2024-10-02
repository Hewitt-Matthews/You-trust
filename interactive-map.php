<?php
// Get data from ACF options page
$map_image = get_field('map_svg_url', 'option');
$map_title = get_field('map_title', 'option');
$map_description = get_field('map_description', 'option');

// Get all map locations
$locations = get_posts(array(
    'post_type' => 'map_locations',
    'posts_per_page' => -1,
));

if ($map_image) : ?>

<div class="interactive-map section section--spaced">
    <div class="wrapper">
        <div class="interactive-map__header">
            <h1><?php echo esc_html($map_title); ?></h1>
            <p><?php echo wp_kses_post($map_description); ?></p>
        </div>

        <div class="interactive-map__container">
            <img src="<?= esc_url($map_image['url']) ?>" alt="<?= esc_attr($map_image['alt']) ?>" class="map-svg">

            <?php foreach ($locations as $location) :
                $pins = get_field('map_pins', $location->ID);
                if ($pins) :
                    foreach ($pins as $pin) :
            ?>
                <div class="map-pin" 
                     data-location="<?= esc_attr($pin['pin_label']) ?>" 
                     data-region="<?= esc_attr($pin['region_value']) ?>"
                     style="left:<?= esc_attr($pin['x_coordinate']) ?>%; top: <?= esc_attr($pin['y_coordinate']) ?>%;">
                    <div class="map-pin__marker"></div>
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
    .interactive-map__container {
        position: relative;
    }
    .map-pin {
        position: absolute;
        transform: translate(-50%, -50%);
    }
    .map-pin__marker {
        width: 10px;
        height: 10px;
        background-color: red;
        border-radius: 50%;
        cursor: pointer;
    }
    .map-pin__info {
        display: none;
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        background-color: white;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: 200px;
    }
    .map-pin:hover .map-pin__info {
        display: block;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mapPins = document.querySelectorAll('.map-pin');
    const mapSvg = document.querySelector('.map-svg');

    mapPins.forEach(pin => {
        pin.addEventListener('mouseenter', () => {
            const region = pin.dataset.region;
            highlightRegion(region);
        });

        pin.addEventListener('mouseleave', () => {
            resetHighlight();
        });
    });

    function highlightRegion(region) {
        // This function should modify the SVG to highlight the specific region
        // You'll need to adjust this based on your SVG structure
        const regionElement = mapSvg.querySelector(`#${region}`);
        if (regionElement) {
            regionElement.style.fill = 'yellow';
        }
    }

    function resetHighlight() {
        // Reset all regions to their original state
        const allRegions = mapSvg.querySelectorAll('[id]');
        allRegions.forEach(region => {
            region.style.fill = '';
        });
    }
});
</script>
