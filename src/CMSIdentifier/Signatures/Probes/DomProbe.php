<?php

namespace Arall\CMSIdentifier\Signatures\Probes;

use Symfony\Component\DomCrawler\Crawler;
use Arall\CMSIdentifier\Website;

class DomProbe extends BooleanProbe
{
    /**
	 * Wanted scope
	 *
	 * @var sting
	 */
    private $scope;

    /**
	 * Website path
	 *
	 * @var sting
	 */
    private $path;

    public function __construct($scope, $score = 0, $path = '/')
    {
        $this->path = $path;
        $this->scope = $scope;
        $this->score = $score;
    }

    public function run(Website $website)
    {
        $content = $website->getContent($this->path);

        $crawler = new Crawler($content);

        if ($crawler->filter($this->scope)->count()) {
            return true;
        }

        return false;
    }
}
