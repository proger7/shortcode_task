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
            custom_offers_table_css($atts['style']);
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
        $tableHTML .= '<div class="wp_shortcode-bridelist_cr-table-style-15 wp_shortcode-bridelist_cr-rating-table">';
        $tableHTML .= '<div class="wp_shortcode-bridelist_table-head">';
        $tableHTML .= '<div class="wp_shortcode-bridelist_visitors-wrapper">
                            <span class="wp_shortcode-bridelist_review-visitors"><span>' . $randomVisitors . '</span> people visited this site today
                                <svg width="11" height="14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.875 0c-3.126 1.72-2.75 6.562-2.75 6.562S2.75 6.125 2.75 4.156C1.11 5.064 0 6.81 0 8.75 0 11.65 2.462 14 5.5 14S11 11.65 11 8.75C11 4.484 6.875 3.61 6.875 0zm-.892 12.191c-1.105.263-2.224-.379-2.5-1.434-.276-1.055.397-2.124 1.502-2.387 2.668-.635 3.003-2.067 3.003-2.067s1.33 5.094-2.005 5.888z" fill="#fff"></path>
                                </svg>
                            </span>
                        </div>';
        $tableHTML .= '<div class="wp_shortcode-bridelist_reviews-updated">
                            <svg width="26" height="26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="m13.584.284 1.66 1.906 2.484-1.059a.742.742 0 0 1 .994.467l.758 2.455 2.694.048a.743.743 0 0 1 .723.83l-.3 2.557 2.442 1.145c.37.175.53.617.356.989-.332.693-.935 1.587-1.343 2.275l1.769 2.047a.75.75 0 0 1-.134 1.096l-2.09 1.484.788 2.592a.744.744 0 0 1-.566.945l-2.506.502-.329 2.688a.744.744 0 0 1-.953.623l-2.443-.557-1.389 2.32a.74.74 0 0 1-1.078.215l-2.052-1.54-2.208 1.554a.737.737 0 0 1-1.07-.249l-1.248-2.242-2.649.517a.742.742 0 0 1-.88-.709l-.229-2.515-2.625-.61a.746.746 0 0 1-.536-.965l.823-2.436-2.152-1.631a.748.748 0 0 1-.055-1.144l1.697-1.843L.63 9.669a.746.746 0 0 1 .357-1.047L3.335 7.61 3.1 4.91a.747.747 0 0 1 .813-.807l2.493.034.878-2.562a.741.741 0 0 1 1.05-.417l2.286 1.06 1.838-1.98a.739.739 0 0 1 1.125.047Zm-6.652 13c-.983-.989.512-2.492 1.495-1.504l3.311 3.33 5.799-6.462c.927-1.036 2.497.384 1.57 1.42l-6.51 7.252a1.054 1.054 0 0 1-1.568.081l-4.097-4.118Z" fill="#ED8A0A"></path>
                            </svg> Updated for November 2024
                        </div>';
        $tableHTML .= '<div class="wp_shortcode-bridelist_cpm-ajax-info wp_shortcode-bridelist_cpm-advertiser-disclosure"></div></div>';
        $tableHTML .= '<div class="wp_shortcode-bridelist_reviews-list">';

        foreach ($newOffersArray as $arr_key => $offer) {
            $highlightClass = $arr_key == 0 ? 'wp_shortcode-bridelist_highlight' : '';
            $imageSrc = "https://cdn.cdndating.net/images/" . esc_attr($arr_key) . ".png";
            $userRating = mt_rand(40, 50) / 10;
            $rating = mt_rand(14, 20) / 2;
            $offerLinkURL = site_url() . "/out/offer.php?id=" . esc_attr($offer['linkID']) . "&o=" . urlencode($arr_key) . "&t=dating";

            $tableHTML .= '<div class="wp_shortcode-bridelist_review-item ' . $highlightClass . '">';
            $tableHTML .= '<div class="wp_shortcode-bridelist_review-logo wp_shortcode-bridelist_partner-link"><img src="' . esc_url($imageSrc) . '" width="180" height="60" class="wp_shortcode-bridelist_cr-logotype-logo wp_shortcode-bridelist_lazyloaded"></div>';
            

            $tableHTML .= '<div class="wp_shortcode-bridelist_review-description wp_shortcode-bridelist_inner-container wp_shortcode-bridelist_mobile-only">';
            if (!empty($offer['bulletPoints'])) {
                $bulletPoints = preg_split('/\r\n|\r|\n/', trim($offer['bulletPoints']));
                $tableHTML .= '<p>' . esc_html(implode(', ', $bulletPoints)) . '</p>';
            }
            $tableHTML .= '</div>';


            $tableHTML .= '<div class="wp_shortcode-bridelist_review-rating wp_shortcode-bridelist_inner-container">
                                <div class="wp_shortcode-bridelist_cr-rating-stars" title="User Rating">
                                    <div class="wp_shortcode-bridelist_fill" style="width: ' . esc_attr(($userRating / 5) * 100) . '%"></div>
                                </div>
                                ' . number_format($userRating, 1) . '/5 rating
                            </div>';
            $tableHTML .= '<div class="wp_shortcode-bridelist_review-score wp_shortcode-bridelist_inner-container">
                                <div class="wp_shortcode-bridelist_score-box">
                                    <div class="wp_shortcode-bridelist_cr-rating-number">' . number_format($rating, 1) . '</div>
                                    <span class="wp_shortcode-bridelist_our-score">Our score</span>
                                </div>
                                <div class="wp_shortcode-bridelist_cr-rating-stars" title="Our Score">
                                    <div class="wp_shortcode-bridelist_fill" style="width: ' . esc_attr(($rating / 10) * 100) . '%"></div>
                                </div>
                            </div>';
            $tableHTML .= '<div class="wp_shortcode-bridelist_review-buttons">
                                <a href="' . esc_url($offerLinkURL) . '" target="_blank" class="wp_shortcode-bridelist_cr-btn wp_shortcode-bridelist_partner-link">Visit Site</a>
                            </div>';
            $tableHTML .= '</div>';
        }

        $tableHTML .= '</div></div>';
    } elseif ($style == 'single1') {
        $randomVisitors = rand(1000, 3000);
        $tableHTML .= '<div class="wp_shortcode-toplist_cr-table-style-15 wp_shortcode-toplist_cr-rating-table">';
        $tableHTML .= '<div class="wp_shortcode-toplist_table-head">';
        $tableHTML .= '<div class="wp_shortcode-toplist_visitors-wrapper">
                            <span class="wp_shortcode-toplist_review-visitors"><span>' . $randomVisitors . '</span> people visited this site today
                                <svg width="11" height="14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.875 0c-3.126 1.72-2.75 6.562-2.75 6.562S2.75 6.125 2.75 4.156C1.11 5.064 0 6.81 0 8.75 0 11.65 2.462 14 5.5 14S11 11.65 11 8.75C11 4.484 6.875 3.61 6.875 0zm-.892 12.191c-1.105.263-2.224-.379-2.5-1.434-.276-1.055.397-2.124 1.502-2.387 2.668-.635 3.003-2.067 3.003-2.067s1.33 5.094-2.005 5.888z" fill="#fff"></path>
                                </svg>
                            </span>
                        </div>';
        $tableHTML .= '<div class="wp_shortcode-toplist_reviews-updated">
                            <svg width="26" height="26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="m13.584.284 1.66 1.906 2.484-1.059a.742.742 0 0 1 .994.467l.758 2.455 2.694.048a.743.743 0 0 1 .723.83l-.3 2.557 2.442 1.145c.37.175.53.617.356.989-.332.693-.935 1.587-1.343 2.275l1.769 2.047a.75.75 0 0 1-.134 1.096l-2.09 1.484.788 2.592a.744.744 0 0 1-.566.945l-2.506.502-.329 2.688a.744.744 0 0 1-.953.623l-2.443-.557-1.389 2.32a.74.74 0 0 1-1.078.215l-2.052-1.54-2.208 1.554a.737.737 0 0 1-1.07-.249l-1.248-2.242-2.649.517a.742.742 0 0 1-.88-.709l-.229-2.515-2.625-.61a.746.746 0 0 1-.536-.965l.823-2.436-2.152-1.631a.748.748 0 0 1-.055-1.144l1.697-1.843L.63 9.669a.746.746 0 0 1 .357-1.047L3.335 7.61 3.1 4.91a.747.747 0 0 1 .813-.807l2.493.034.878-2.562a.741.741 0 0 1 1.05-.417l2.286 1.06 1.838-1.98a.739.739 0 0 1 1.125.047Zm-6.652 13c-.983-.989.512-2.492 1.495-1.504l3.311 3.33 5.799-6.462c.927-1.036 2.497.384 1.57 1.42l-6.51 7.252a1.054 1.054 0 0 1-1.568.081l-4.097-4.118Z" fill="#ED8A0A"></path>
                            </svg> Updated for November 2024
                        </div>';
        $tableHTML .= '<div class="wp_shortcode-toplist_cpm-ajax-info wp_shortcode-toplist_cpm-advertiser-disclosure"></div></div>';
        $tableHTML .= '<div class="wp_shortcode-toplist_reviews-list">';

        foreach ($newOffersArray as $arr_key => $offer) {
            $highlightClass = $arr_key == 0 ? 'wp_shortcode-toplist_highlight' : '';
            $imageSrc = "https://cdn.cdndating.net/images/" . esc_attr($arr_key) . ".png";
            $userRating = mt_rand(40, 50) / 10;
            $rating = mt_rand(14, 20) / 2;
            $offerLinkURL = site_url() . "/out/offer.php?id=" . esc_attr($offer['linkID']) . "&o=" . urlencode($arr_key) . "&t=dating";

            $tableHTML .= '<div class="wp_shortcode-toplist_review-item ' . $highlightClass . '">';
            $tableHTML .= '<div class="wp_shortcode-toplist_review-logo wp_shortcode-toplist_partner-link"><img src="' . esc_url($imageSrc) . '" width="180" height="60" class="wp_shortcode-toplist_cr-logotype-logo wp_shortcode-toplist_lazyloaded"></div>';
            
            $tableHTML .= '<div class="wp_shortcode-toplist_review-description wp_shortcode-toplist_inner-container wp_shortcode-toplist_mobile-only">';
            if (!empty($offer['bulletPoints'])) {
                $bulletPoints = preg_split('/\r\n|\r|\n/', trim($offer['bulletPoints']));
                $tableHTML .= '<p>' . esc_html(implode(', ', $bulletPoints)) . '</p>';
            }
            $tableHTML .= '</div>';

            $tableHTML .= '<div class="wp_shortcode-toplist_review-rating wp_shortcode-toplist_inner-container">
                                <div class="wp_shortcode-toplist_cr-rating-stars" title="User Rating">
                                    <div class="wp_shortcode-toplist_fill" style="width: ' . esc_attr(($userRating / 5) * 100) . '%"></div>
                                </div>
                                ' . number_format($userRating, 1) . '/5 rating
                            </div>';
            $tableHTML .= '<div class="wp_shortcode-toplist_review-score wp_shortcode-toplist_inner-container">
                                <div class="wp_shortcode-toplist_score-box">
                                    <div class="wp_shortcode-toplist_cr-rating-number">' . number_format($rating, 1) . '</div>
                                    <span class="wp_shortcode-toplist_our-score">Our score</span>
                                </div>
                                <div class="wp_shortcode-toplist_cr-rating-stars" title="Our Score">
                                    <div class="wp_shortcode-toplist_fill" style="width: ' . esc_attr(($rating / 10) * 100) . '%"></div>
                                </div>
                            </div>';
            $tableHTML .= '<div class="wp_shortcode-toplist_review-buttons">
                                <a href="' . esc_url($offerLinkURL) . '" target="_blank" class="wp_shortcode-toplist_cr-btn wp_shortcode-toplist_partner-link">Visit Site</a>
                            </div>';
            $tableHTML .= '</div>';
        }

        $tableHTML .= '</div></div>';
    } elseif ($style == 'style3') {
        $tableHTML .= '<div class="insp_woman_wp_shortcode-bridelist_cr-table-style-45 insp_woman_wp_shortcode-bridelist_cr-rating-table">';
        foreach ($newOffersArray as $arr_key => $offer) {
            $highlightClass = $arr_key == 0 ? 'insp_woman_has-review' : '';
            $imageSrc = "https://cdn.cdndating.net/images/" . esc_attr($arr_key) . ".png";
            $userRating = mt_rand(40, 50) / 10;
            $ratingPercentage = esc_attr(($userRating / 5) * 100);
            $ratingFormatted = number_format($userRating, 1);
            $offerLinkURL = site_url() . "/out/offer.php?id=" . esc_attr($offer['linkID']) . "&o=" . urlencode($arr_key) . "&t=dating";

            $tableHTML .= '<div class="insp_woman_review-item ' . $highlightClass . ' insp_woman_snipcss-xGlZY">';
            $tableHTML .= '<div class="insp_woman_review-logo">';
            $tableHTML .= '<figure class="insp_woman_partner-link insp_woman_data-1566-reviews-table">';
            $tableHTML .= '<img decoding="async" src="' . esc_url($imageSrc) . '" width="130" height="62" alt="' . esc_attr($offer['brandName'] ?? '') . '" class="insp_woman_cr-logotype-logo insp_woman_ls-is-cached insp_woman_lazyloaded">';
            $tableHTML .= '<figcaption>' . esc_html($offer['brandName'] ?? '') . '</figcaption>';
            $tableHTML .= '</figure>';
            $tableHTML .= '</div>';
            $tableHTML .= '<div class="insp_woman_cr-rating-stars" title="Our Score">';
            $tableHTML .= '<div class="insp_woman_fill" style="width: ' . $ratingPercentage . '%"></div>';
            $tableHTML .= '</div>';
            $tableHTML .= '<div class="insp_woman_cr-rating-number">' . $ratingFormatted . '</div>';
            $tableHTML .= '<a href="' . esc_url($offerLinkURL) . '" class="insp_woman_cr-btn insp_woman_square insp_woman_default-size insp_woman_site-btn insp_woman_partner-link insp_woman_data-1566-reviews-table" target="_blank">Visit Site</a>';
            $tableHTML .= '</div>';
        }
        $tableHTML .= '</div>';
    } elseif ($style == 'style4') {

        $newOffersArray = include __DIR__ . '/offers-mail-bride-data.php';

        $atts = shortcode_atts([
            'offers' => '',
        ], $atts);

        $offerKeys = array_filter(array_map('trim', explode(',', $atts['offers'])));
        $filteredOffersArray = array_intersect_key($newOffersArray['brands'], array_flip($offerKeys));

        if (empty($filteredOffersArray)) {
            return '<p>No offers found for the specified keys.</p>';
        }

        $tableHTML = '<div class="mailbride_site_review-table-wrapper">';
        foreach ($filteredOffersArray as $arr_key => $offer) {
            $highlightClass = $arr_key === "sofia-date" ? 'mailbride_site_highlight-review' : '';
            $imageSrc = "https://cdn.cdndating.net/images/" . esc_attr($arr_key) . ".png";
            $ratingFormatted = number_format($offer['rating'], 1);
            $offerLinkURL = site_url() . "/out/offer.php?id=" . esc_attr($offer['linkID']) . "&o=" . urlencode($arr_key) . "&t=dating";

            $tableHTML .= '<div class="mailbride_site_review-item ' . esc_attr($highlightClass) . ' mailbride_site_snipcss0-0-0-1">';
            $tableHTML .= '    <div class="mailbride_site_review-image mailbride_site_partner-link mailbride_site_data-339-reviews-table mailbride_site_snipcss0-1-1-2">';
            $tableHTML .= '        <img decoding="async" src="' . esc_url($imageSrc) . '" width="245" height="300" alt="' . esc_attr($offer['brandName']) . ' Logo" class="mailbride_site_cr-logotype-thumbnail mailbride_site_lazyloaded mailbride_site_snipcss0-2-2-3">';
            $tableHTML .= '    </div>';
            $tableHTML .= '    <div class="mailbride_site_review-info mailbride_site_snipcss0-1-1-4">';
            $tableHTML .= '        <div class="mailbride_site_review-name-rating mailbride_site_snipcss0-2-4-5">';
            $tableHTML .= '            <div class="mailbride_site_review-name mailbride_site_partner-link mailbride_site_data-339-reviews-table mailbride_site_snipcss0-3-5-6">' . esc_html($offer['brandName']) . '</div>';
            $tableHTML .= '            <div class="mailbride_site_review-rating mailbride_site_snipcss0-3-5-7">';
            $tableHTML .= '                <div class="mailbride_site_cr-rating-number mailbride_site_snipcss0-4-7-8">' . esc_html($ratingFormatted) . '</div>';
            $tableHTML .= '                <svg width="15" height="20" viewBox="0 0 15 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="mailbride_site_snipcss0-4-7-9">';
            $tableHTML .= '                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.23321 15.4298C4.33232 15.4764 4.44065 15.5003 4.55029 15.5C4.66963 15.4926 4.78533 15.4564 4.88727 15.3943L7.991 13.7787L11.0947 15.3943C11.2164 15.4559 11.3529 15.4827 11.489 15.4716C11.6252 15.4606 11.7555 15.4121 11.8655 15.3317C11.9754 15.2513 12.0607 15.1421 12.1117 15.0164C12.1628 14.8906 12.1775 14.7532 12.1544 14.6196L11.5736 11.2078L14.0787 8.7822C14.1769 8.687 14.2463 8.56645 14.2791 8.43416C14.3119 8.30187 14.3068 8.16311 14.2644 8.03354C14.2219 7.90397 14.1439 7.78876 14.039 7.70091C13.9341 7.61306 13.8066 7.55607 13.6708 7.53637L10.2079 7.03452L8.65165 3.91775C8.59197 3.79276 8.49779 3.68715 8.38006 3.61321C8.26233 3.53926 8.12588 3.5 7.98656 3.5C7.84725 3.5 7.71079 3.53926 7.59306 3.61321C7.47533 3.68715 7.38115 3.79276 7.32148 3.91775L5.77405 7.03452L2.32005 7.53197C2.18427 7.55167 2.05674 7.60866 1.95185 7.69651C1.84697 7.78436 1.76891 7.89957 1.72649 8.02914C1.68406 8.1587 1.67897 8.29746 1.71177 8.42975C1.74457 8.56205 1.81397 8.6826 1.91213 8.7778L4.41728 11.1946L3.82757 14.6196C3.80511 14.7261 3.80691 14.8363 3.83285 14.9421C3.85878 15.0478 3.90818 15.1465 3.97745 15.2309C4.04672 15.3153 4.1341 15.3832 4.23321 15.4298Z" fill="#F1C862"></path>';
            $tableHTML .= '                </svg>';
            $tableHTML .= '            </div>';
            $tableHTML .= '        </div>';
            $tableHTML .= '        <button class="mailbride_site_cr-btn mailbride_site_square mailbride_site_big-size mailbride_site_review-mobile-button mailbride_site_partner-link mailbride_site_data-339-reviews-table mailbride_site_snipcss0-2-4-10" type="button">Visit Site</button>';
            $tableHTML .= '        <div class="mailbride_site_review-pros-cons mailbride_site_snipcss0-2-4-11">';
            $tableHTML .= '            <ul class="mailbride_site_cr-cpm_offer_pros-list mailbride_site_snipcss0-3-11-12">';
            foreach ($offer['pros'] as $pro) {
                $tableHTML .= '                <li class="mailbride_site_snipcss0-4-12-13">' . esc_html($pro) . '</li>';
            }
            $tableHTML .= '            </ul>';
            $tableHTML .= '            <ul class="mailbride_site_cr-cpm_offer_cons-list mailbride_site_snipcss0-3-11-16">';
            foreach ($offer['cons'] as $con) {
                $tableHTML .= '                <li class="mailbride_site_snipcss0-4-16-17">' . esc_html($con) . '</li>';
            }
            $tableHTML .= '            </ul>';
            $tableHTML .= '        </div>';
            $tableHTML .= '        <div class="mailbride_site_review-special-offer mailbride_site_partner-link mailbride_site_data-339-reviews-table mailbride_site_snipcss0-2-4-19"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="16" viewBox="0 0 14 16" fill="none" class="snipcss0-3-19-20">
                <path d="M6.25782 3.98155H1.99336C1.70327 3.98155 1.42513 4.09676 1.22013 4.3019C1.01511 4.50693 0.899902 4.78505 0.899902 5.07501V6.93388C0.899902 7.09496 1.03036 7.22554 1.19145 7.22554H6.29413L6.25782 3.98155Z" fill="#F02E73"></path>
                <path d="M11.9803 3.98155H7.71582V7.22535H12.8185L12.8186 7.22548C12.8959 7.22548 12.9701 7.19472 13.0247 7.14005C13.0794 7.08537 13.1102 7.01118 13.1102 6.9338V5.07493C13.1103 4.7785 12.9901 4.49478 12.7771 4.28865C12.5641 4.0824 12.2766 3.97161 11.9802 3.98148L11.9803 3.98155Z" fill="#F02E73"></path>
                <path d="M6.25744 8.31911H1.51904V12.3793C1.51904 12.6692 1.63425 12.9474 1.83927 13.1525C2.04441 13.3575 2.32254 13.4727 2.6125 13.4727H6.25744V8.31911Z" fill="#F02E73"></path>
                <path d="M7.71582 8.31911V13.4727H11.3608C11.6507 13.4727 11.9289 13.3575 12.134 13.1525C12.339 12.9473 12.4542 12.6692 12.4542 12.3793V8.31911H7.71582Z" fill="#F02E73"></path>
                <path d="M10.3401 0.511648C10.1712 0.511282 10.0027 0.528489 9.83718 0.562659C9.30423 0.61123 8.80378 0.839806 8.41813 1.21092C8.03261 1.58191 7.78486 2.07312 7.71582 2.60386C7.71765 2.67805 7.74987 2.74823 7.80503 2.79789C7.86019 2.84756 7.93341 2.87221 8.00749 2.86623H10.1215C10.7631 2.86623 11.8274 2.72772 11.8274 1.78731H11.8273C11.8113 1.41644 11.6424 1.06863 11.3605 0.826881C11.0787 0.585125 10.7093 0.471009 10.3401 0.511654L10.3401 0.511648Z" fill="#F02E73"></path>
                <path d="M6.25781 2.6038C6.18935 2.07538 5.94368 1.58576 5.56109 1.21502C5.17838 0.844273 4.68133 0.614335 4.15107 0.562599C3.98559 0.528427 3.81707 0.511223 3.64802 0.511588C3.27434 0.462164 2.897 0.57224 2.60852 0.814971C2.32003 1.0577 2.14699 1.41062 2.13184 1.78724C2.13184 2.72767 3.19611 2.86616 3.83756 2.86616H6.02447C6.2578 2.86616 6.2578 2.60379 6.2578 2.60379L6.25781 2.6038Z" fill="#F02E73"></path>
            </svg>';
            $tableHTML .= '            ' . esc_html($offer['shortDescription']) . '';
            $tableHTML .= '        </div>';
            $tableHTML .= '        <div class="mailbride_site_review-buttons mailbride_site_snipcss0-2-4-21">';
            $tableHTML .= '            <a href="' . esc_url($offerLinkURL) . '" class="mailbride_site_cr-btn mailbride_site_square mailbride_site_big-size mailbride_site_partner-link mailbride_site_data-339-reviews-table mailbride_site_snipcss0-3-21-22" target="_blank">Visit Site</a>';
            $tableHTML .= '        </div>';
            $tableHTML .= '    </div>';
            $tableHTML .= '</div>';
        }
        $tableHTML .= '</div>';


        return $tableHTML;
    } elseif ($style == 'style5') {

            $newOffersArray = include __DIR__ . '/offers-hookupguru-data.php';
            $tableHTML = '<div class="ad_wbc_all_reviews ad_wbc_snipcss-J8FO5" show-banner="false" data-v-ef4df5c3="" data-v-5fde7f3a="">';
            $ratings = [];
            for ($i = 5.0; $i >= 3.6; $i -= 0.2) {
                $ratings[] = number_format($i, 1);
            }
            $ratingIndex = 0;

            $scoreOptions = [];
            for ($i = 7.0; $i <= 10.0; $i += 0.1) {
                $scoreOptions[] = number_format($i, 1);
            }

            foreach ($newOffersArray as $arr_key => $offer) {
                $highlightClass = $arr_key == 0 ? 'ad_wbc_highlight-offer' : '';
                $signUpLink = '/sign-up';
                $reviewLink = esc_url($offer['readReviewLink']);
                $currentRating = $ratings[$ratingIndex];
                $ratingIndex = ($ratingIndex + 1) % count($ratings);
                $randomScore = $scoreOptions[array_rand($scoreOptions)];
                $offerPageLink = site_url() . "/out/offer.php?id=" . esc_attr($offer['linkID']) . "&o=" . urlencode($arr_key) . "&t=dating";

                $tableHTML .= '<div class="ad_wbc_post_preview ' . $highlightClass . '" data-v-5fde7f3a="" data-v-de82ba65="">';
                $tableHTML .= '<a href="' . esc_url($offerPageLink) . '" class="ad_wbc_webcam ad_wbc_post_img_pr" data-v-de82ba65="">';
                $tableHTML .= '<div class="ad_wbc_filter" data-v-de82ba65="">';
                $tableHTML .= '<div data-text="' . esc_attr($offer['brandName']) . '" class="ad_wbc_title_logo" data-v-de82ba65="">' . esc_html($offer['brandName']) . '</div>';
                $tableHTML .= '</div>';
                $tableHTML .= '</a>';
                $tableHTML .= '<div class="ad_wbc_info" data-v-de82ba65="">';
                $tableHTML .= '<div class="ad_wbc_first_block" data-v-de82ba65="">';
                $tableHTML .= '<a href="' . esc_url($offerPageLink) . '" class="ad_wbc_title" data-v-de82ba65="">' . esc_html($offer['brandName']) . '</a>';
                $tableHTML .= '<div class="ad_wbc_stars-wrapper" data-v-de82ba65="" data-v-d9c24a74="">';
                $tableHTML .= '<div class="ad_wbc_info" data-v-d9c24a74="">';
                $tableHTML .= '<div class="ad_wbc_score" data-v-d9c24a74="">' . $randomScore . '</div>';
                $tableHTML .= '<div class="ad_wbc_stars" data-v-d9c24a74="">';

                $fullStars = 0;

                if ($randomScore >= 9.0 && $randomScore <= 9.5) {
                    $fullStars = 4;
                } elseif ($randomScore > 9.5) {
                    $fullStars = 5;
                } elseif ($randomScore >= 8.0 && $randomScore < 9.0) {
                    $fullStars = 3;
                } elseif ($randomScore >= 7.0 && $randomScore < 8.0) {
                    $fullStars = 2;
                } elseif ($randomScore < 7.0) {
                    $fullStars = 1;
                }

                for ($i = 0; $i < 5; $i++) {
                    if ($i < $fullStars) {
                        $tableHTML .= '<span data-v-d9c24a74="" class="ad_wbc_full"></span>';
                    } else {
                        $tableHTML .= '<span data-v-d9c24a74="" class="ad_wbc_empty"></span>';
                    }
                }

                $tableHTML .= '</div>';
                $tableHTML .= '</div>';
                $tableHTML .= '</div>';
                $tableHTML .= '</div>';
                $tableHTML .= '<div class="ad_wbc_second_block" data-v-de82ba65="">';
                $tableHTML .= '<a class="ad_wbc_btn_pink ad_wbc_external_link" target="_blank" href=' . $signUpLink . ' data-v-de82ba65="">Sign Up</a>';
                $tableHTML .= '</div>';
                $tableHTML .= '</div>';
                $tableHTML .= '<div class="ad_wbc_info_second" data-v-de82ba65="">';
                $tableHTML .= '<div class="ad_wbc_block ad_wbc_online" data-v-de82ba65="">';
                $tableHTML .= '<div class="ad_wbc_header" data-v-de82ba65="">Users Online</div>';
                $tableHTML .= '<div class="ad_wbc_text" data-v-de82ba65="">&nbsp;' . esc_html($offer['usersOnline']) . '</div>';
                $tableHTML .= '</div>';
                $tableHTML .= '<div class="ad_wbc_block ad_wbc_rate" data-v-de82ba65="">';
                $tableHTML .= '<div class="ad_wbc_header" data-v-de82ba65="">Hookup Rate</div>';
                $tableHTML .= '<div class="ad_wbc_text" data-v-de82ba65="">' . esc_html($offer['hookupRate']) . '<span class="ad_wbc_percent" data-v-de82ba65="">%</span></div>';
                $tableHTML .= '</div>';
                $tableHTML .= '<div class="ad_wbc_block ad_wbc_gender" data-v-de82ba65="">';
                $tableHTML .= '<div class="ad_wbc_header" data-v-de82ba65="">Gender Rating</div>';
                $tableHTML .= '<div class="ad_wbc_text" data-v-de82ba65="">';
                $tableHTML .= '<div class="ad_wbc_men" data-v-de82ba65="">&nbsp;' . esc_html($offer['genderRatingMale']) . '<span class="ad_wbc_percent" data-v-de82ba65="">%</span></div>';
                $tableHTML .= '<div class="ad_wbc_women" data-v-de82ba65="">&nbsp;' . esc_html($offer['genderRatingFemale']) . '<span class="ad_wbc_percent" data-v-de82ba65="">%</span></div>';
                $tableHTML .= '</div>';
                $tableHTML .= '</div>';
                $tableHTML .= '<div class="ad_wbc_block ad_wbc_safety" data-v-de82ba65="">';
                $tableHTML .= '<div class="ad_wbc_header" data-v-de82ba65="">Safety</div>';
                $tableHTML .= '<div class="ad_wbc_text" data-v-de82ba65="">' . $currentRating . '<span class="ad_wbc_score" data-v-de82ba65=""> / 5.0</span></div>';
                $tableHTML .= '</div>';
                $tableHTML .= '</div>';
                $tableHTML .= '</div>';
            }
            $tableHTML .= '</div>';

    } elseif ($style == 'top1') {
            $newOffersArray = include __DIR__ . '/offers-aimojo-data.php';

            $atts = shortcode_atts([
                'offers' => '',
            ], $atts);

            $offerKeys = array_filter(array_map('trim', explode(',', $atts['offers'])));

            $filteredOffersArray = array_intersect_key($newOffersArray, array_flip($offerKeys));

            if (empty($filteredOffersArray)) {
                return '<p>No offers found for the specified keys.</p>';
            }

            $tableHTML = '<div class="aimojo_st_comparison-wrapper aimojo_st_snipcss0-0-0-1 aimojo_st_snipcss-vno3X">';

            foreach ($filteredOffersArray as $arr_key => $offer) {
                $imageSrc = "https://cdn.cdndating.net/images/" . esc_attr($arr_key) . ".png";
                $offerLinkURL = site_url() . "/out/offer.php?id=" . esc_attr($offer['linkID']) . "&o=" . urlencode($arr_key) . "&t=dating";
                $labelName = esc_html($offer['labelName']);
                $brandName = esc_html($offer['brandName']);
                $bulletPoints = nl2br(esc_html($offer['bulletPoints']));
                $labelButton = esc_html($offer['labelButton']);

                $tableHTML .= '<div class="aimojo_st_comparison-item aimojo_st_snipcss0-1-1-2">';
                $tableHTML .= '    <div class="aimojo_st_item-header aimojo_st_snipcss0-2-2-3 aimojo_st_style-9KM7g" data-match-height="itemHeader">';
                $tableHTML .= '        <div class="aimojo_st_item-badge aimojo_st_snipcss0-3-3-4 aimojo_st_style-o1fJI">' . $labelName . '</div>';
                $tableHTML .= '        <div class="aimojo_st_product-image aimojo_st_snipcss0-3-3-5">';
                $tableHTML .= '            <div class="aimojo_st_image aimojo_st_snipcss0-4-5-6">';
                $tableHTML .= '                <img fetchpriority="high" decoding="async" src="' . esc_url($imageSrc) . '" class="aimojo_st_attachment-full aimojo_st_size-full aimojo_st_snipcss0-5-6-7" width="160" height="160" alt="' . $brandName . ' Logo">';
                $tableHTML .= '            </div>';
                $tableHTML .= '        </div>';
                $tableHTML .= '        <div class="aimojo_st_item-title aimojo_st_snipcss0-3-3-8 aimojo_st_style-iXbas"><strong>' . $brandName . '</strong></div>';
                $tableHTML .= '        <div class="aimojo_st_item-rating aimojo_st_snipcss0-3-3-10">';
                $tableHTML .= '            <div class="aimojo_st_item-stars-rating aimojo_st_snipcss0-4-10-11">';
                for ($i = 0; $i < 5; $i++) {
                    $tableHTML .= '                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="33 -90 360 360">';
                    $tableHTML .= '                    <polygon fill="#F6A123" points="281.1,129.8 364,55.7 255.5,46.8 214,-59 172.5,46.8 64,55.4 146.8,129.7 121.1,241 213.9,181.1 213.9,181 306.5,241 "></polygon>';
                    $tableHTML .= '                </svg>';
                }
                $tableHTML .= '            </div>';
                $tableHTML .= '        </div>';
                $tableHTML .= '        <a href="' . esc_url($offerLinkURL) . '" rel="nofollow noopener sponsored" target="_blank" style="background-color: #7635f3" class="aimojo_st_gss-item-btn aimojo_st_gspb_track_btn aimojo_st_re_track_btn aimojo_st_snipcss0-3-3-17">' . $labelButton . '</a>';
                $tableHTML .= '    </div>';
                $tableHTML .= '    <div class="aimojo_st_item-row-description aimojo_st_item-row-bottomline aimojo_st_snipcss0-2-2-18 aimojo_st_style-h7PD1" data-match-height="itemBottomline">';
                $tableHTML .= '        <div class="aimojo_st_item-row-title aimojo_st_snipcss0-3-18-19">Bottom Line</div>';
                $tableHTML .= '        ' . $bulletPoints;
                $tableHTML .= '    </div>';
                $tableHTML .= '</div>';
            }

            $tableHTML .= '</div>';

            return $tableHTML;

    }

    return $tableHTML;
}


function custom_offers_table_css($style) {
    $handle = "offers-table-css-$style";
    if (!wp_style_is($handle, 'enqueued')) {
        $css_url = site_url() . "/wp-content/themes/generatepress/js/css/tables/$style.css";
        wp_enqueue_style($handle, $css_url);
    }
}