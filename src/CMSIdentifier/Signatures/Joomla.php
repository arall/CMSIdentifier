<?php

namespace Arall\CMSIdentifier\Signatures;

use Arall\CMSIdentifier\Website;

class Joomla extends \Arall\CMSIdentifier\Signature
{
    /**
     * Product vendor
     *
     * @var string
     */
    public $vendor = 'Joomla';

    /**
     * Product name
     *
     * @var string
     */
    public $product = 'Joomla';

    /**
     * Construct
     *
     * @param Website $website
     */
    public function __construct(Website $website)
    {
        parent::__construct($website);

        $this->probes = array(
            new Probes\MetaGeneratorProbe('Joomla!',    100),
            new Probes\RobotsProbe('administrator',     10),
            new Probes\RobotsProbe('cache',             10),
            new Probes\RobotsProbe('images',            10),
            new Probes\RobotsProbe('media',             10),
            new Probes\RobotsProbe('components',        10),
            new Probes\RobotsProbe('includes',          10),
            new Probes\RobotsProbe('modules',           10),
            new Probes\RobotsProbe('plugins',           10),
            new Probes\RobotsProbe('templates',         10),
            new Probes\DomProbe('input[name="passwd"]', 80, '/administrator'),
        );
    }
}
