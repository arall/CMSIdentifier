<?php

namespace Arall\CMSIdentifier;

use \Curl\Curl;

class Website
{
    /**
	 * Website URL
	 *
	 * @var string
	 */
    public $url;

    /**
     * Website contents
     *
     * @var array
     */
    public $contents = array(
        '/' => null
    );

    /**
	 * Website responses
	 *
	 * @var array
	 */
    public $responses = array(
    );

    /**
	 * Construct
     *
	 * @param string $url
     * @throws Exception If the URL is not valid
     * @throws Exception If the content is empty
	 */
    public function __construct($url)
    {
        // Is valid?
        if (filter_var($url, FILTER_VALIDATE_URL)) {

            // Store
            $this->url = $url;

            // Get index
            if ($this->getContent()) {
                return true;
            } else {
                throw new \Exception('Empty content');
            }
        }

        // Invalid domain
        throw new \Exception('Invalid URL: ' . $url);
    }

    /**
     * Get URL content
     *
     * @param  string $path
     * @param  bool   $force Force request (ignore cache)
     * @return string
     */
    public function getContent($path = '/', $force = false)
    {
        // Non existing content?
        if ($force || !isset($this->contents[$path])) {

            $curl = new Curl();
            $curl->setOpt(CURLOPT_RETURNTRANSFER,   true);
            $curl->setOpt(CURLOPT_AUTOREFERER,      true);
            $curl->setOpt(CURLOPT_FOLLOWLOCATION,   true);
            $curl->get($this->url . $path);

            if ($curl->error) {
                return false;
            }

            $this->contents[$path] = $curl->response;
        }

        return $this->contents[$path];
    }

    /**
     * Get URL header response
     *
     * @param  string $path
     * @param  bool   $force Force request (ignore cache)
     * @return string
     */
    public function getResponse($path = '/', $force = false)
    {
        // Non existing content?
        if ($force || !isset($this->responses[$path])) {

            $curl = new Curl();
            $curl->setOpt(CURLOPT_RETURNTRANSFER,   true);
            $curl->setOpt(CURLOPT_AUTOREFERER,      true);
            $curl->setOpt(CURLOPT_FOLLOWLOCATION,   true);
            $curl->get($this->url . $path);

            if ($curl->error) {
                return false;
            }

            $this->responses[$path] = $curl;
        }

        return $this->responses[$path];
    }
}
