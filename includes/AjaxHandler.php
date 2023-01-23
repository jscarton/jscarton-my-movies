<?php
namespace Jscarton\MyMovies;

class AjaxHandler
{
    /**
     * Action hook used by the AJAX class.
     *
     * @var string
     */
    const ACTION = 'movies_list';

    /**
     * Action argument used by the nonce validating the AJAX request.
     *
     * @var string
     */
    const NONCE = 'my-movies-ajax';

    /**
     * Register the AJAX handler class with all the appropriate WordPress hooks.
     */
    public static function register()
    {
        $handler = new self();

        add_action('wp_ajax_' . self::ACTION, array($handler, 'handle'));
        add_action('wp_ajax_nopriv_' . self::ACTION, array($handler, 'handle'));
    }

    /**
     * Handles the AJAX request for my plugin.
     */
    public function handle()
    {
        // Make sure we are getting a valid AJAX request
        check_ajax_referer(self::NONCE);
        global $wpdb;
        $rows = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}my_movies");
        echo json_encode($rows);
        die();
    }

    /**
     * Sends a JSON response with the details of the given error.
     *
     * @param WP_Error $error
     */
    private function send_error(WP_Error $error)
    {
        wp_send_json(array(
            'code' => $error->get_error_code(),
            'message' => $error->get_error_message()
        ));
    }
}