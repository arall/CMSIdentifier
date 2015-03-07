<?php

namespace Arall\CMSIdentifier\Signatures\Probes;

use Arall\CMSIdentifier\Website;

class MetaGeneratorProbe extends BooleanProbe
{
    /**
	 * Wanted generator name
	 *
	 * @var string
	 */
    private $generator;

    /**
     * Website path
     *
     * @var string
     */
    private $path;

    public function __construct($generator, $path = '/', $score = 0)
    {
        $this->generator = strtolower($generator);
        $this->score = $score;
        $this->path = $path;
    }

    public function run(Website $website)
    {
        $content = strtolower($website->getContent($this->path));

        $regex = '<meta (name=[\'"]generator[\'"] ?|content=[\'"].*'.$this->generator.'.*[\'"] ?){2,}/?>';

        if (preg_match($regex, $content)) {
            return true;
        }

        return false;
    }
}
