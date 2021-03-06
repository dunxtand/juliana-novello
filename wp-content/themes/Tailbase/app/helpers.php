<?php

/**
 * Returns the fully qualified path to the images directory.
 *
 * @since 1.1.0
 *
 * @param null $file
 *
 * @return string
 */
function images_path($file = null)
{
    return get_stylesheet_directory_uri() . '/resources/assets/images/' . $file;
}

/**
 * Initialize maintenance mode
 *
 * @since 1.4.0
 *
 * @param $maintenance
 * @param $template
 */
function tail_base_maintenance($maintenance, $template)
{
    $tail_base_maintenance = function () use ($template) {
        $context = Timber::get_context();
        status_header(503);
        die(\Timber::compile($template, $context));
    };

    switch ($maintenance) {
        case 'full':
            add_action('init', $tail_base_maintenance);
            break;
        case 'enable':
            if (!current_user_can('administrator')) {
                // Frontend
                add_filter('template_include', $tail_base_maintenance);

                // REST API
                add_action('rest_api_init', $tail_base_maintenance);
            }
            break;
    }
}

/**
 * Return the value of an environment variable.
 * Return default value if environment variable is false.
 *
 * @param $env_variable
 * @param $default
 *
 * @return array|false|string
 */
function bc_env($env_variable, $default)
{
    return getenv($env_variable) ? getenv($env_variable) : $default;
}

/**
 * Return random string
 *
 * @since 1.9.0
 *
 * @param int $length
 * @return void
 */
function bc_random_string($length)
{
    return substr(bin2hex(random_bytes($length)), 0, $length);
}

/**
 * Return true if assets file exists
 *
 * @param string $key
 * @return boolean
 */
function has_assets($key)
{
    $manifest_string = file_get_contents(get_template_directory() . '/dist/manifest.json');
    $manifest_array  = json_decode($manifest_string, true);

    return @file_get_contents(get_template_directory() . '/dist/' . $manifest_array[$key]);
}
