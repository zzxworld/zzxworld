<?php

if (!function_exists('asset_url')) {
    function asset_url($endpoint)
    {
        $manifestFile = base_path('public/assets/js/manifest.json');
        if (file_exists($manifestFile)) {
            $mapping = json_decode(file_get_contents($manifestFile), true);
            if (isset($mapping[$endpoint])) {
                $endpoint = $mapping[$endpoint];
            }
        }

        return url('assets/js/'.$endpoint);
    }
}
