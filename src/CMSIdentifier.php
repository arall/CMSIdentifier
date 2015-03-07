<?php

namespace Arall;

use Arall\CMSIdentifier\Website;

class CMSIdentifier
{

    /**
	 * Website
	 *
	 * @var CMSIdentifier\Website
	 */
    private $website;

    /**
     * Results
     *
     * @var array
     */
    private $results = array();

    /**
     * Signatures
     */
    private $signatures = array(
        'Arall\CMSIdentifier\Signatures\Joomla',
        'Arall\CMSIdentifier\Signatures\Wordpress',
        'Arall\CMSIdentifier\Signatures\Drupal',
    );

    /**
	 * Construct
     *
	 * @param string $url
	 */
    public function __construct($url)
    {
        $this->website = new Website($url);

        $this->execute();
    }

    /**
     * Identify CMS from content
     *
     * @return bool
     */
    public function execute()
    {
        foreach ($this->signatures as $class) {
            $signature = new $class($this->website);
            $signature->run();
            $this->results[] = array(
                'vendor'    => $signature->vendor,
                'product'   => $signature->product,
                'score'     => $signature->getScore(),
                'version'   => $signature->getVersion(),
            );
        }
    }

    /**
     * Get results
     *
     * @return array
     */
    public function getResults()
    {
        return $this->results;
    }
}
