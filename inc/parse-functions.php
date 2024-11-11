<?php

/**
 * Parse functions.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * A wrapper function to parse table from the site `mail-order-bride-sites`.
 *
 *
 * @return string The parsed value.
 */
function newTables($atts) {
    global $externalTableSettings;
    global $isCloakActive;
    global $newOffersArray;

    if (empty($newOffersArray)) {
        $newOffersArray = include __DIR__ . '/offers-data.php';
    }

    // Extract attributes from the shortcode.
    $atts = shortcode_atts(array(
        'offers' => 'povr',
        'tag' => '',
        'style' => 'default',
    ), $atts);

    if (!$isCloakActive || ($isCloakActive && !cloakIPChecker())) {

        // Enqueue CSS based on the style attribute
        // --------------------------------------------
        if (!empty($atts['style'])) {
            enqueue_offers_table_css($atts['style']);
        }

        // Count offers using faster way
        // --------------------------------------------
        $offersCount = substr_count($atts['offers'], ',') + 1;

        // Get HTML from function
        // --------------------------------------------
        $tableHTML = newTableLayouts($atts, $newOffersArray);

        // Process shortcodes within the table content
        return $tableHTML;
//      return do_shortcode($tableHTML);
    }

    return ''; // return empty if cloakActive() is true and cloakIPChecker() is true
}

add_shortcode('new_table', 'newTables');

/**
 * Function to generate the HTML layout for the offers table based on the new data structure
 *
 *
 * @return string The parsed value.
 */
function newTableLayouts($atts, $newOffersArray) {
    // Start building the table HTML
    $tableHTML = '<div class="offers-table ' . esc_attr($atts['style']) . '">';

    // Add table header (optional)
    $tableHTML .= '<div class="offers-table-header">
                       <h3>Top-rated Offers</h3>
                   </div>';

    // Loop through the offers in the array and build rows
    foreach ($newOffersArray as $key => $offer) {
        $tableHTML .= '<div class="offer-row">';
        $tableHTML .= '<div class="offer-title">' . esc_html($offer['brandName']) . '</div>';
        $tableHTML .= '<div class="offer-bullets">' . wp_kses_post(nl2br($offer['bulletPoints'])) . '</div>';
        $tableHTML .= '<div class="offer-price">Price: ' . esc_html($offer['price']) . '</div>';
        $tableHTML .= '<div class="offer-button">
                           <a href="https://example.com?linkID=' . esc_attr($offer['linkID']) . '" target="_blank">Visit Site</a>
                       </div>';
        $tableHTML .= '</div>';
    }
    $tableHTML .= '</div>';

    return $tableHTML;
}

function enqueue_offers_table_css($style) {
    static $styles_enqueued = array();

    if (!in_array($style, $styles_enqueued)) {
        $css_url = site_url() . "/js/css/tables/$style.css";
        wp_enqueue_style("offers-table-css-$style", $css_url);
        $styles_enqueued[] = $style;
    }
}