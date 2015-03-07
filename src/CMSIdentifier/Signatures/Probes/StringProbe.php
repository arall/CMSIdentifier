<?php

namespace Arall\CMSIdentifier\Signatures\Probes;

use Arall\CMSIdentifier\Website;

class StringProbe extends BooleanProbe
{
    /**
	 * Wanted string
	 *
	 * @var sting
	 */
    private $string;

    /**
     * Website path
     *
     * @var sting
     */
    private $path;

    public function __construct($string, $score = 0, $path = '/')
    {
        $this->string = strtolower($string);
        $this->score = $score;
        $this->path = $path;
    }

    public function run(Website $website)
    {
        $content = strtolower($website->getContent($this->path));

        if (strstr($content, $this->string)) {
            return true;
        }

        return false;
    }
}
