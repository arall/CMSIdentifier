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

    public function __construct($string = false, $key = false, $path = '/', $score = 0)
    {
        $this->string = $string;
        $this->score = $score;
        $this->key = $key;
        $this->path = $path;
    }

    public function run(Website $website)
    {
        if ($this->string && $this->key) {
            if ($response = $website->getResponse($this->path)) {
                if ($response->response_headers[ucfirst($this->key)] == $this->string) {
                    return true;
                }
            }
        }

        return false;
    }
}
