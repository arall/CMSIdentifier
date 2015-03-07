<?php

namespace Arall\CMSIdentifier\Signatures\Probes;

use Arall\CMSIdentifier\Website;

class ResponseCodeProbe extends BooleanProbe
{
    /**
     * Website path
     *
     * @var string
     */
    private $path;

    /**
     * Response code
     *
     * @var integer
     */
    private $code;

    public function __construct($path = false, $code = 200, $score = 0)
    {
        $this->path = $path;
        $this->code = $code;
        $this->score = $score;
    }

    public function run(Website $website)
    {
        if ($this->path && $response = $website->getResponse($this->path)) {
            if ($response->http_status_code == $this->code) {
                return true;
            }
        }

        return false;
    }
}
