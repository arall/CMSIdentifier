<?php

namespace Arall\CMSIdentifier\Signatures\Probes;

use Arall\CMSIdentifier\Website;

class RobotsProbe extends BooleanProbe
{
    /**
	 * Wanted string
	 *
	 * @var sting
	 */
    private $string;

    public function __construct($string, $score = 0)
    {
        $this->string = $string;
        $this->score = $score;
    }

    public function run(Website $website)
    {
        $content = $website->getContent('/robots.txt');

        if (strstr($content, $this->string)) {
            return true;
        }

        return false;
    }
}
