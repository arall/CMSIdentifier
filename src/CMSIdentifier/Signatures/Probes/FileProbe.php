<?php

namespace Arall\CMSIdentifier\Signatures\Probes;

use Arall\CMSIdentifier\Website;

class FileProbe extends BooleanProbe
{
    /**
     * Website path
     *
     * @var string
     */
    private $path;

    public function __construct($path = false, $score = 0)
    {
        $this->path = $path;
        $this->score = $score;
    }

    public function run(Website $website)
    {
        if($this->path && $response = $website->getResponse($this->path)) {
            if($response->http_status_code == 200) {
                return true;
            }
        }

        return false;
    }
}
