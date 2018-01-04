<?php

use L5Swagger\Exceptions\L5SwaggerException;

if (! function_exists('swagger_ui_dist_path')) {
    /**
     * Returns swagger-ui composer dist path.
     *
     * @param null $asset
     *
     * @return string
     * @throws \L5Swagger\Exceptions\L5SwaggerException
     */
    function swagger_ui_dist_path($asset = null)
    {
        $allowed_files = [
            'favicon-16x16.png',
            'favicon-32x32.png',
        ];

        $path = base_path('vendor/swagger-api/swagger-ui/dist/');

        if (! $asset) {
            return realpath($path);
        }

        if (! in_array($asset, $allowed_files)) {
            throw new L5SwaggerException(sprintf('(%s) - this L5 Swagger asset is not allowed', $asset));
        }

        return realpath($path.$asset);
    }
}

if (! function_exists('l5_swagger_asset')) {
    /**
     * Returns asset from swagger-ui composer package.
     *
     * @param $asset string
     *
     * @return string
     * @throws \L5Swagger\Exceptions\L5SwaggerException
     */
    function l5_swagger_asset($asset)
    {
        $file = swagger_ui_dist_path($asset);

        if (! file_exists($file)) {
            throw new L5SwaggerException(sprintf('Requested L5 Swagger asset file (%s) does not exists', $asset));
        }

        return route('l5-swagger.asset', $asset);
    }
}
