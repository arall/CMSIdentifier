<?php

namespace Arall\CMSIdentifier\Signatures\Probes;

use Symfony\Component\DomCrawler\Crawler;
use Arall\CMSIdentifier\Website;

class DomProbe extends BooleanProbe
{
    /**
	 * Wanted scope
	 *
	 * @var string
	 */
    private $scope;

    /**
	 * Website path
	 *
	 * @var string
	 */
    private $path;

    public function __construct($scope, $path = '/', $score = 0)
    {
        $this->path = $path;
        $this->scope = $scope;
        $this->score = $score;
    }

    public function run(Website $website)
    {
        if ($content = $website->getContent($this->path)) {

            $crawler = new Crawler($content);

            if ($crawler->filter($this->scope)->count()) {
                return true;
            }
        }

        return false;
    }
}
