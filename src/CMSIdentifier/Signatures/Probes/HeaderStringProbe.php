<?php

namespace Arall\CMSIdentifier\Signatures\Probes;

use Arall\CMSIdentifier\Website;

class HeaderStringProbe extends BooleanProbe
{
    /**
     * Custom string
     *
     * @var string
     */
    private $string;

    /**
     * Response header key
     *
     * @var string
     */
    private $key;

    /**
     * Website path
     *
     * @var string
     */
    private $path;

    public function __construct($string = false, $score = 0, $key = false, $path = '/')
    {
        $this->string = $string;
        $this->score = $score;
        $this->key = $key;
        $this->path = $path;
    }

    public function run(Website $website)
    {
        if($this->string && $this->key && $website->getResponse($this->path)->response_headers[ucfirst($this->key)] == $this->string) {
            return true;
        }

        return false;
    }
}
