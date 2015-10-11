<?php

namespace Flower\Router\Response\Header;

class Status extends Base
{
    /**
     * This HTTP header does not match key: value pattern
     *
     * @var null
     */
    protected $key = null;

    /**
     * HTTP Version
     */
    const HTTP_VERSION = '1.1';

    /**
     * Available HTTP status
     */
    const HTTP_200 = 200;
    const HTTP_301 = 301;
    const HTTP_302 = 302;
    const HTTP_404 = 404;
    const HTTP_500 = 500;

    /**
     * Mapping to status message
     */
    public static $label = array(
        self::HTTP_200 => 'OK',
        self::HTTP_301 => 'Moved Permanently',
        self::HTTP_302 => 'Moved Temporarily',
        self::HTTP_404 => 'Not Found',
        self::HTTP_500 => 'Server Error'
    );

    /**
     * Initialize Status object
     *
     * @param integer $code
     */
    public function __construct($code)
    {
        $this->check($code);
        $this->value = 'HTTP/' . self::HTTP_VERSION . ' ' . $code . ' ' . $this->message($code);
    }

    /**
     * Check if HTTP status code is configured
     *
     * @param integer $code
     * @throws \Exception
     */
    private function check($code)
    {
        if (!isset(self::$label[$code])) {
            throw new \Exception('Message for HTTP status not found: ' . $code);
        }
    }

    /**
     * Get status message for status code
     *
     * @param integer $code
     * @return string
     */
    private function message($code)
    {
        return self::$label[$code];
    }
}