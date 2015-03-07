<?php

namespace Arall\CMSIdentifier;

abstract class Signature
{
    /**
	 * Website
	 *
	 * @var Arall\CMSIdentifier\Website
	 */
    protected $website;

    /**
     * Score (0/100)
     *
     * @var integer
     */
    protected $score;

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
     * Get product name
     *
     * @return string
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Get vendor name
     *
     * @return string
     */
    public function getVendor()
    {
        return $this->vendor;
    }

    /**
     * Get Score
     *
     * @return float
     */
    public function getScore()
    {
        return round($this->score * 100, 2);
    }

    /**
     * Get version
     *
     * @return false
     */
    public function getVersion()
    {
        return false;
    }
}
