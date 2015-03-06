<?php

namespace Arall\CMSIdentifier;

abstract class Signature
{
    /**
	 * Website
	 *
	 * @var Arall\CMSIdentifier\Website
	 */
    private $website;

    /**
     * Score (0/100)
     *
     * @var integer
     */
    private $score;

    /**
     * Product version
     *
     * @var string
     */
    private $version;

    /**
     * Probes
     *
     * @var array
     */
    protected $probes = array();

    public function __construct(Website $website)
    {
        $this->website = $website;
    }

    /**
     * Execute the identifier
     *
     * @return bool
     */
    public function run()
    {
        $score = 0;
        $total = 0;
        foreach ($this->probes as $probe) {
            if ($probe->run($this->website)) {
                $score += $probe->score;
            }
            $total += $probe->score;
        }

        return $this->score = $score / $total;
    }

    /**
     * Get Score
     *
     * @return integer
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Get version
     *
     * @return srting
     */
    public function getVersion()
    {
        return $this->version;
    }
}
