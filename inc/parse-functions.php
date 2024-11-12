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


?>

<div class="cr-table-style-23 cr-rating-table">
   <div class="table-head">
      <div class="editors-choice">Casual Dating Site</div>
      <div class="rating-meta">
         <div class="reviews-updated">
            <svg width="18" height="25" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path fill-rule="evenodd" clip-rule="evenodd" d="M17.5967 6.77552c.2198.21967.2198.57582 0 .79549L9.23738 15.9254c-.2198.2197-.57617.2197-.79597 0l-4.00703-4.0046c-.2198-.2197-.2198-.5759 0-.7955l.7428-.7424c.21981-.2197.57617-.2197.79597 0l2.86625 2.8645 7.2185-7.21424c.2198-.21967.5762-.21967.796 0l.7428.74236Z" fill="#4BBB8B"></path>
               <path d="M17.5604 12.6105c.2487 0 .4515.2016.4391.4499-.0884 1.7656-.6956 3.4699-1.7505 4.8972-1.1442 1.5482-2.7549 2.6891-4.5957 3.255-1.84079.566-3.81463.5273-5.63176-.1105-1.81713-.6377-3.38181-1.8409-4.46434-3.4328-1.082524-1.592-1.6258656-3.4888-1.55025419-5.4121C.0825572 10.3338.773139 8.48545 1.97731 6.9833c1.20416-1.50215 2.85848-2.57892 4.72007-3.07222 1.71622-.45478 3.52522-.39157 5.20042.17627.2355.07983.3484.34247.2569.57354l-.1658.4184c-.0915.23108-.3528.34288-.589.26514-1.40588-.46278-2.91938-.50921-4.35632-.12844-1.58236.41931-2.98853 1.33456-4.01207 2.61139-1.02354 1.27682-1.61053 2.84802-1.6748 4.48282-.06427 1.6348.39757 3.2471 1.31772 4.6002.92014 1.3532 2.25012 2.3759 3.79468 2.918 1.54456.5421 3.22233.575 4.78699.0939 1.5647-.481 2.9338-1.4508 3.9064-2.7668.8832-1.195 1.3972-2.6185 1.4842-4.0952.0146-.2481.2148-.4498.4635-.4498h.4502Z" fill="#4BBB8B"></path>
            </svg>
            Updated for November 2024
         </div>
      </div>
   </div>
   <div class="reviews-list set-positions">
      <div class="review-item highlight" data-position="1">
         <div class="review-item-logo type-logo partner-link data-8-reviews-table ">
            <img decoding="async" src="https://mail-order-bride-sites.com/wp-content/uploads/2024/01/SofiaDate.svg" width="180" height="60" alt="SofiaDate Logo" class="cr-logotype-logo ls-is-cached lazyloaded" data-src="https://mail-order-bride-sites.com/wp-content/uploads/2024/01/SofiaDate.svg">        
         </div>
         <div class="review-info-block rating-block">
            <div class="review-info-block-label">
               Our score

            </div>
            <div class="rating">
               <div class="cr-rating-number">4.8</div>
               <div class="cr-rating-stars" title="Our Score">
                  <div class="fill" style="width: 96%"></div>
               </div>
            </div>
         </div>
         <div class="review-info-block user-rating-block">
            <div class="review-info-block-label">
               User Rating

            </div>
            <div class="user-rating">
               9.3                
            </div>
         </div>
         <div class="review-buttons">
            <button class="cr-btn small-rounded default-size site-btn partner-link data-8-reviews-table" type="button">Visit Site</button><a href="https://mail-order-bride-sites.com/reviews/sofiadate/" class="review-link cr-btn cr-btn-plain small-rounded default-size">Read Review</a>        
         </div>
      </div>
      <div class="review-item " data-position="2">
         <div class="review-item-logo type-logo partner-link data-34-reviews-table ">
            <img decoding="async" src="https://mail-order-bride-sites.com/wp-content/uploads/2023/11/sakuradate.svg" width="178" height="46" alt="SakuraDate Logo" class="cr-logotype-logo ls-is-cached lazyloaded" data-src="https://mail-order-bride-sites.com/wp-content/uploads/2023/11/sakuradate.svg">        
         </div>
         <div class="review-info-block rating-block">
            <div class="review-info-block-label">
               Our score

            </div>
            <div class="rating">
               <div class="cr-rating-number">4.8</div>
               <div class="cr-rating-stars" title="Our Score">
                  <div class="fill" style="width: 96%"></div>
               </div>
            </div>
         </div>
         <div class="review-info-block user-rating-block">
            <div class="review-info-block-label">
               User Rating

            </div>
            <div class="user-rating">
               8.8                
            </div>
         </div>
         <div class="review-buttons">
            <button class="cr-btn small-rounded default-size site-btn partner-link data-34-reviews-table" type="button">Visit Site</button><a href="https://mail-order-bride-sites.com/reviews/sakuradate/" class="review-link cr-btn cr-btn-plain small-rounded default-size">Read Review</a>        
         </div>
      </div>
      <div class="review-item " data-position="3">
         <div class="review-item-logo type-logo partner-link data-21-reviews-table ">
            <img decoding="async" src="https://mail-order-bride-sites.com/wp-content/uploads/2024/01/latidate.svg" width="176" height="48" alt="LatiDate Logo" class="cr-logotype-logo ls-is-cached lazyloaded" data-src="https://mail-order-bride-sites.com/wp-content/uploads/2024/01/latidate.svg">        
         </div>
         <div class="review-info-block rating-block">
            <div class="review-info-block-label">
               Our score

            </div>
            <div class="rating">
               <div class="cr-rating-number">4.8</div>
               <div class="cr-rating-stars" title="Our Score">
                  <div class="fill" style="width: 96%"></div>
               </div>
            </div>
         </div>
         <div class="review-info-block user-rating-block">
            <div class="review-info-block-label">
               User Rating

            </div>
            <div class="user-rating">
               7.3                
            </div>
         </div>
         <div class="review-buttons">
            <button class="cr-btn small-rounded default-size site-btn partner-link data-21-reviews-table" type="button">Visit Site</button><a href="https://mail-order-bride-sites.com/reviews/latidate/" class="review-link cr-btn cr-btn-plain small-rounded default-size">Read Review</a>        
         </div>
      </div>
      <div class="review-item " data-position="4">
         <div class="review-item-logo type-logo partner-link data-20-reviews-table ">
            <img decoding="async" src="https://mail-order-bride-sites.com/wp-content/uploads/2023/12/goldenbride.svg" width="180" height="60" alt="GoldenBride Logo" class="cr-logotype-logo ls-is-cached lazyloaded" data-src="https://mail-order-bride-sites.com/wp-content/uploads/2023/12/goldenbride.svg">        
         </div>
         <div class="review-info-block rating-block">
            <div class="review-info-block-label">
               Our score

            </div>
            <div class="rating">
               <div class="cr-rating-number">4.7</div>
               <div class="cr-rating-stars" title="Our Score">
                  <div class="fill" style="width: 94%"></div>
               </div>
            </div>
         </div>
         <div class="review-info-block user-rating-block">
            <div class="review-info-block-label">
               User Rating

            </div>
            <div class="user-rating">
               9.3                
            </div>
         </div>
         <div class="review-buttons">
            <button class="cr-btn small-rounded default-size site-btn partner-link data-20-reviews-table" type="button">Visit Site</button><a href="https://mail-order-bride-sites.com/reviews/goldenbride/" class="review-link cr-btn cr-btn-plain small-rounded default-size">Read Review</a>        
         </div>
      </div>
      <div class="review-item " data-position="5">
         <div class="review-item-logo type-logo partner-link data-17-reviews-table ">
            <img decoding="async" src="https://mail-order-bride-sites.com/wp-content/uploads/2024/01/UkraineBrides4You.svg" width="181" height="60" alt="UkraineBride4you Logo" class="cr-logotype-logo ls-is-cached lazyloaded" data-src="https://mail-order-bride-sites.com/wp-content/uploads/2024/01/UkraineBrides4You.svg">        
         </div>
         <div class="review-info-block rating-block">
            <div class="review-info-block-label">
               Our score

            </div>
            <div class="rating">
               <div class="cr-rating-number">4.8</div>
               <div class="cr-rating-stars" title="Our Score">
                  <div class="fill" style="width: 95%"></div>
               </div>
            </div>
         </div>
         <div class="review-info-block user-rating-block">
            <div class="review-info-block-label">
               User Rating

            </div>
            <div class="user-rating">
               8.9                
            </div>
         </div>
         <div class="review-buttons">
            <button class="cr-btn small-rounded default-size site-btn partner-link data-17-reviews-table" type="button">Visit Site</button><a href="https://mail-order-bride-sites.com/reviews/ukrainebride4you/" class="review-link cr-btn cr-btn-plain small-rounded default-size">Read Review</a>        
         </div>
      </div>
      <div class="review-item " data-position="6">
         <div class="review-item-logo type-logo partner-link data-15-reviews-table ">
            <img decoding="async" src="https://mail-order-bride-sites.com/wp-content/uploads/2023/12/LuckyDate.svg" width="180" height="60" alt="TheLuckyDate Logo" class="cr-logotype-logo ls-is-cached lazyloaded" data-src="https://mail-order-bride-sites.com/wp-content/uploads/2023/12/LuckyDate.svg">        
         </div>
         <div class="review-info-block rating-block">
            <div class="review-info-block-label">
               Our score

            </div>
            <div class="rating">
               <div class="cr-rating-number">4.7</div>
               <div class="cr-rating-stars" title="Our Score">
                  <div class="fill" style="width: 94%"></div>
               </div>
            </div>
         </div>
         <div class="review-info-block user-rating-block">
            <div class="review-info-block-label">
               User Rating

            </div>
            <div class="user-rating">
               8.6                
            </div>
         </div>
         <div class="review-buttons">
            <button class="cr-btn small-rounded default-size site-btn partner-link data-15-reviews-table" type="button">Visit Site</button><a href="https://mail-order-bride-sites.com/reviews/theluckydate/" class="review-link cr-btn cr-btn-plain small-rounded default-size">Read Review</a>        
         </div>
      </div>
      <div class="review-item " data-position="7">
         <div class="review-item-logo type-logo partner-link data-28-reviews-table ">
            <img decoding="async" src="https://mail-order-bride-sites.com/wp-content/uploads/2023/12/LatamDate.svg" width="180" height="60" alt="LatamDate Logo" class="cr-logotype-logo lazyloaded" data-src="https://mail-order-bride-sites.com/wp-content/uploads/2023/12/LatamDate.svg">        
         </div>
         <div class="review-info-block rating-block">
            <div class="review-info-block-label">
               Our score

            </div>
            <div class="rating">
               <div class="cr-rating-number">4.7</div>
               <div class="cr-rating-stars" title="Our Score">
                  <div class="fill" style="width: 93%"></div>
               </div>
            </div>
         </div>
         <div class="review-info-block user-rating-block">
            <div class="review-info-block-label">
               User Rating

            </div>
            <div class="user-rating">
               8.6                
            </div>
         </div>
         <div class="review-buttons">
            <button class="cr-btn small-rounded default-size site-btn partner-link data-28-reviews-table" type="button">Visit Site</button><a href="https://mail-order-bride-sites.com/reviews/latamdate/" class="review-link cr-btn cr-btn-plain small-rounded default-size">Read Review</a>        
         </div>
      </div>
   </div>
</div>






<?php
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
        $css_url = site_url() . "/wp-content/themes/generatepress/js/css/tables/$style.css";
        wp_enqueue_style("offers-table-css-$style", $css_url);
        $styles_enqueued[] = $style;
    }
}