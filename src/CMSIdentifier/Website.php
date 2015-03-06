<?php

namespace Arall\CMSIdentifier;

class Website
{
    /**
	 * Website URL
	 *
	 * @var string
	 */
    public $url;

    /**
	 * Website index
	 *
	 * @var string
	 */
    public $content;

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
            $this->content = $this->getContent();

            // Empty content?
            if (!$this->content) {
                throw new Exception('Empty content');
            }

            return true;
        }

        // Invalid domain
        throw new \Exception('Invalid URL: ' . $url);
    }

    /**
     * Get URL content
     *
     * @return
     */
    private function getContent()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,               $this->url);
        curl_setopt($ch, CURLOPT_USERAGENT,         'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.41 Safari/537.36');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,    true);
        curl_setopt($ch, CURLOPT_AUTOREFERER,       true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,    true);

        return curl_exec($ch);
    }
}
