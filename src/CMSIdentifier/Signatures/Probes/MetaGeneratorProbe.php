<?php

namespace Arall\CMSIdentifier\Signatures\Probes;

use Arall\CMSIdentifier\Website;

class MetaGeneratorProbe extends BooleanProbe
{
    /**
	 * Wanted generator name
	 *
	 * @var sting
	 */
    private $generator;

    /**
     * Website path
     *
     * @var string
     */
    private $path;

    public function __construct($generator, $score = 0, $path = '/')
    {
        $this->generator = $generator;
        $this->path = $path;
        $this->score = $score;
    }

    public function run(Website $website)
    {
        $content = '';
        if (!$this->path || $this->path == '/') {
            $content = $website->content;
        }

        $regex = '<meta (name=[\'"]generator[\'"] ?|content=[\'"]'.$this->generator.'[\w -]+[\'"] ?){2,}/>';

        if (preg_match($regex, $content)) {
            return true;
        }

        return false;
    }
}
