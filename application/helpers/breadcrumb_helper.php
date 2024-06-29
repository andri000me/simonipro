<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('generate_breadcrumb')) {
    function generate_breadcrumb($segments) {
        $base_url = base_url();
        $breadcrumb = '<nav aria-label="breadcrumb"><ol class="breadcrumb">';
        $url = '';

        // Loop through each segment
        foreach ($segments as $index => $segment) {
            // Skip if the segment is a numeric ID
            if (is_numeric($segment)) {
                continue;
            }

            $url .= $segment . '/';
            $title = str_replace('_', ' ', $segment);

            // Check if this is the last segment
            if ($index == count($segments) - 1 || (isset($segments[$index + 1]) && is_numeric($segments[$index + 1]))) {
                $breadcrumb .= '<li class="breadcrumb-item text-capitalize active" aria-current="page">' . ucwords($title) . '</li>';
            } else {
                $breadcrumb .= '<li class="breadcrumb-item text-capitalize"><a href="' . $base_url . $url . '">' . ucwords($title) . '</a></li>';
            }
        }

        $breadcrumb .= '</ol></nav>';

        return $breadcrumb;
    }
}
?>
