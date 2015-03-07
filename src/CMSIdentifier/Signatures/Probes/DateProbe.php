<?php

namespace Arall\CMSIdentifier\Signatures\Probes;

use Arall\CMSIdentifier\Website;

class DateProbe extends BooleanProbe
{
    /**
     * Custom date
     *
     * @var string
     */
    private $date;

    /**
     * Kind of date
     *
     * @var string
     */
    private $dateType;

    /**
     * Website path
     *
     * @var string
     */
    private $path;

    public function __construct($date = false, $score = 0, $dateType = 'expires', $path = '/')
    {
        $this->date = $date;
        $this->score = $score;
        $this->dateType = ucfirst($dateType);
        $this->path = $path;
    }

    public function run(Website $website)
    {
        if($this->date && $website->getResponse($this->path)->response_headers[$this->dateType] == $this->date) {
            return true;
        }

        return false;
    }
}
