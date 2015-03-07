<?php

namespace Arall\CMSIdentifier\Signatures\Probes;

use Arall\CMSIdentifier\Website;

class ContentStringProbe extends BooleanProbe
{
    /**
	 * Wanted string
	 *
	 * @var string
	 */
    private $string;

    /**
     * Website path
     *
     * @var string
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
