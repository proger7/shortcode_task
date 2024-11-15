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

    $atts = shortcode_atts(array(
        'offers' => 'povr',
        'tag' => '',
        'style' => 'style1',
    ), $atts);

    if (!$isCloakActive || ($isCloakActive && !cloakIPChecker())) {
        if (!empty($atts['style'])) {
            enqueue_offers_table_css($atts['style']);
        }

        $offerKeys = array_map('trim', explode(',', $atts['offers']));
        $filteredOffersArray = array_filter($newOffersArray, function($key) use ($offerKeys) {
            return in_array($key, $offerKeys);
        }, ARRAY_FILTER_USE_KEY);

        $tableHTML = newTableLayouts($atts, $filteredOffersArray);
        return $tableHTML;
    }

    return '';
}

add_shortcode('new_table', 'newTables');

function newTableLayouts($atts, $newOffersArray) {
    $style = $atts['style'];
    $tableHTML = '';

    if ($style == 'style1') {
        $tableHTML .= '<div class="shortcode-wp_cr-table-style-23 shortcode-wp_cr-rating-table ' . esc_attr($atts['style']) . '">';
        $tableHTML .= '<div class="shortcode-wp_table-head">
                            <div class="shortcode-wp_editors-choice">Casual Dating Site</div>
                            <div class="shortcode-wp_rating-meta">
                                <div class="shortcode-wp_reviews-updated">
                                    <svg width="18" height="25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17.5967 6.77552c.2198.21967.2198.57582 0 .79549L9.23738 15.9254c-.2198.2197-.57617.2197-.79597 0l-4.00703-4.0046c-.2198-.2197-.2198-.5759 0-.7955l.7428-.7424c.21981-.2197.57617-.2197.79597 0l2.86625 2.8645 7.2185-7.21424c.2198-.21967.5762-.21967.796 0l.7428.74236Z" fill="#4BBB8B"></path>
                                        <path d="M17.5604 12.6105c.2487 0 .4515.2016.4391.4499-.0884 1.7656-.6956 3.4699-1.7505 4.8972-1.1442 1.5482-2.7549 2.6891-4.5957 3.255-1.84079.566-3.81463.5273-5.63176-.1105-1.81713-.6377-3.38181-1.8409-4.46434-3.4328-1.082524-1.592-1.6258656-3.4888-1.55025419-5.4121C.0825572 10.3338.773139 8.48545 1.97731 6.9833c1.20416-1.50215 2.85848-2.57892 4.72007-3.07222 1.71622-.45478 3.52522-.39157 5.20042.17627.2355.07983.3484.34247.2569.57354l-.1658.4184c-.0915.23108-.3528.34288-.589.26514-1.40588-.46278-2.91938-.50921-4.35632-.12844-1.58236.41931-2.98853 1.33456-4.01207 2.61139-1.02354 1.27682-1.61053 2.84802-1.6748 4.48282-.06427 1.6348.39757 3.2471 1.31772 4.6002.92014 1.3532 2.25012 2.3759 3.79468 2.918 1.54456.5421 3.22233.575 4.78699.0939 1.5647-.481 2.9338-1.4508 3.9064-2.7668.8832-1.195 1.3972-2.6185 1.4842-4.0952.0146-.2481.2148-.4498.4635-.4498h.4502Z" fill="#4BBB8B"></path>
                                    </svg>
                                    Updated for November 2024
                                </div>
                            </div>
                        </div>';

        $tableHTML .= '<div class="shortcode-wp_reviews-list shortcode-wp_set-positions">';
        $isFirst = true;
        $rating = 5.0;

        foreach ($newOffersArray as $arr_key => $offer) {
            $highlightClass = $isFirst ? 'shortcode-wp_highlight' : '';
            $imageSrc = "https://cdn.cdndating.net/images/" . esc_attr($arr_key) . ".png";
            $userRating = mt_rand(80, 100) / 10;

            $offerLinkURL = site_url() . "/out/offer.php?id=" . esc_attr($offer['linkID']) . "&o=" . urlencode($arr_key) . "&t=dating";

            $tableHTML .= '<div class="shortcode-wp_review-item ' . $highlightClass . '" data-position="' . esc_attr($arr_key) . '">';
            $tableHTML .= '<div class="shortcode-wp_review-item-logo shortcode-wp_type-logo shortcode-wp_partner-link shortcode-wp_data-' . esc_attr($arr_key) . '-reviews-table">';
            $tableHTML .= '<img decoding="async" src="' . esc_url($imageSrc) . '" width="180" height="60" alt="' . esc_attr($offer['brandName']) . ' Logo" class="shortcode-wp_cr-logotype-logo ls-is-cached lazyloaded">';
            $tableHTML .= '</div>';

            $tableHTML .= '<div class="shortcode-wp_review-info-block shortcode-wp_rating-block">';
            $tableHTML .= '<div class="shortcode-wp_review-info-block-label">Our score</div>';
            $tableHTML .= '<div class="shortcode-wp_rating">';
            $tableHTML .= '<div class="shortcode-wp_cr-rating-number">' . number_format($rating, 1) . '</div>';
            $tableHTML .= '<div class="shortcode-wp_cr-rating-stars" title="Our Score"><div class="shortcode-wp_fill" style="width: ' . esc_attr(($rating / 5) * 100) . '%"></div></div>';
            $tableHTML .= '</div></div>';

            $tableHTML .= '<div class="shortcode-wp_review-info-block shortcode-wp_user-rating-block">';
            $tableHTML .= '<div class="shortcode-wp_review-info-block-label">User Rating</div>';
            $tableHTML .= '<div class="shortcode-wp_user-rating">' . number_format($userRating, 1) . '</div>';
            $tableHTML .= '</div>';

            $tableHTML .= '<div class="shortcode-wp_review-buttons">';
            $tableHTML .= '<a target="_blank" href="' . esc_url($offerLinkURL) . '" class="shortcode-wp_cr-btn shortcode-wp_small-rounded shortcode-wp_default-size shortcode-wp_site-btn shortcode-wp_partner-link shortcode-wp_data-' . esc_attr($arr_key) . '-reviews-table">Visit Site</a>';
            $tableHTML .= '<a href="https://example.com?linkID=' . esc_attr($offer['linkID']) . '" class="shortcode-wp_review-link shortcode-wp_cr-btn shortcode-wp_cr-btn-plain shortcode-wp_small-rounded shortcode-wp_default-size">Read Review</a>';
            $tableHTML .= '</div></div>';

            $isFirst = false;
            $rating -= 0.5;
            if ($rating < 4.0) $rating = 4.0;
        }

        $tableHTML .= '</div></div>';
    } elseif ($style == 'style2') {
        $randomVisitors = rand(1000, 3000);
        $tableHTML .= '<div class="cr-table-style-15 cr-rating-table">';
        $tableHTML .= '<div class="table-head">';
        $tableHTML .= '<div class="visitors-wrapper">
                            <span class="review-visitors"><span>' . $randomVisitors . '</span> people visited this site today
                                <svg width="11" height="14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.875 0c-3.126 1.72-2.75 6.562-2.75 6.562S2.75 6.125 2.75 4.156C1.11 5.064 0 6.81 0 8.75 0 11.65 2.462 14 5.5 14S11 11.65 11 8.75C11 4.484 6.875 3.61 6.875 0zm-.892 12.191c-1.105.263-2.224-.379-2.5-1.434-.276-1.055.397-2.124 1.502-2.387 2.668-.635 3.003-2.067 3.003-2.067s1.33 5.094-2.005 5.888z" fill="#fff"></path>
                                </svg>
                            </span>
                        </div>';
        $tableHTML .= '<div class="reviews-updated">
                            <svg width="26" height="26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="m13.584.284 1.66 1.906 2.484-1.059a.742.742 0 0 1 .994.467l.758 2.455 2.694.048a.743.743 0 0 1 .723.83l-.3 2.557 2.442 1.145c.37.175.53.617.356.989-.332.693-.935 1.587-1.343 2.275l1.769 2.047a.75.75 0 0 1-.134 1.096l-2.09 1.484.788 2.592a.744.744 0 0 1-.566.945l-2.506.502-.329 2.688a.744.744 0 0 1-.953.623l-2.443-.557-1.389 2.32a.74.74 0 0 1-1.078.215l-2.052-1.54-2.208 1.554a.737.737 0 0 1-1.07-.249l-1.248-2.242-2.649.517a.742.742 0 0 1-.88-.709l-.229-2.515-2.625-.61a.746.746 0 0 1-.536-.965l.823-2.436-2.152-1.631a.748.748 0 0 1-.055-1.144l1.697-1.843L.63 9.669a.746.746 0 0 1 .357-1.047L3.335 7.61 3.1 4.91a.747.747 0 0 1 .813-.807l2.493.034.878-2.562a.741.741 0 0 1 1.05-.417l2.286 1.06 1.838-1.98a.739.739 0 0 1 1.125.047Zm-6.652 13c-.983-.989.512-2.492 1.495-1.504l3.311 3.33 5.799-6.462c.927-1.036 2.497.384 1.57 1.42l-6.51 7.252a1.054 1.054 0 0 1-1.568.081l-4.097-4.118Z" fill="#ED8A0A"></path>
                            </svg> Updated for November 2024
                        </div>';
        $tableHTML .= '<div class="cpm-ajax-info cpm-advertiser-disclosure"></div></div>';
        $tableHTML .= '<div class="reviews-list">';

        $rating = 5.0;

        foreach ($newOffersArray as $arr_key => $offer) {
            $highlightClass = $arr_key == 0 ? 'highlight' : '';
            $imageSrc = "https://cdn.cdndating.net/images/" . esc_attr($arr_key) . ".png";
            $userRating = mt_rand(80, 100) / 10;
            $offerLinkURL = site_url() . "/out/offer.php?id=" . esc_attr($offer['linkID']) . "&o=" . urlencode($arr_key) . "&t=dating";

            $tableHTML .= '<div class="review-item ' . $highlightClass . '">';
            $tableHTML .= '<div class="review-site-label">Site of the day</div>';
            $tableHTML .= '<div class="review-logo partner-link"><img src="' . esc_url($imageSrc) . '" width="180" height="60" class="cr-logotype-logo lazyloaded"></div>';
            
            $tableHTML .= '<div class="review-description inner-container">';
            if (!empty($offer['bulletPoints'])) {
                $bulletPoints = preg_split('/\r\n|\r|\n/', trim($offer['bulletPoints']));
                $tableHTML .= '<p>' . esc_html(implode(', ', $bulletPoints)) . '</p>';
            }
            $tableHTML .= '</div>';

            $tableHTML .= '<div class="review-rating inner-container">
                                <div class="cr-rating-stars" title="User Rating">
                                    <div class="fill" style="width: ' . esc_attr(($userRating / 5) * 100 - 100) . '%"></div>
                                </div>
                                ' . number_format($userRating, 1) . '/10 rating
                            </div>';
            $tableHTML .= '<div class="review-score inner-container">
                                <div class="score-box">
                                    <div class="cr-rating-number">' . number_format($rating, 1) . '</div>
                                    <span class="our-score">Our score</span>
                                </div>
                                <div class="cr-rating-stars" title="Our Score">
                                    <div class="fill" style="width: ' . esc_attr(($rating / 5) * 100) . '%"></div>
                                </div>
                            </div>';
            $tableHTML .= '<div class="review-buttons">
                                <a href="' . esc_url($offerLinkURL) . '" target="_blank" class="cr-btn partner-link">Visit Site</a>
                            </div>';
            $tableHTML .= '</div>';

            $rating -= 0.5;
            if ($rating < 4.0) $rating = 4.0;
        }

        $tableHTML .= '</div></div>';
    }

    return $tableHTML;
}


function enqueue_offers_table_css($style) {
    $handle = "offers-table-css-$style";
    if (!wp_style_is($handle, 'enqueued')) {
        $css_url = site_url() . "/wp-content/themes/generatepress/js/css/tables/$style.css";
        wp_enqueue_style($handle, $css_url);
    }
}