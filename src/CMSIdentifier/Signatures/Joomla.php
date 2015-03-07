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
            new Probes\MetaGeneratorProbe($this->product,   100),
            new Probes\StringProbe('administrator',         10, '/robots.txt'),
            new Probes\StringProbe('cache',                 10, '/robots.txt'),
            new Probes\StringProbe('images',                10, '/robots.txt'),
            new Probes\StringProbe('media',                 10, '/robots.txt'),
            new Probes\StringProbe('components',            10, '/robots.txt'),
            new Probes\StringProbe('includes',              10, '/robots.txt'),
            new Probes\StringProbe('modules',               10, '/robots.txt'),
            new Probes\StringProbe('plugins',               10, '/robots.txt'),
            new Probes\StringProbe('templates',             10, '/robots.txt'),
            new Probes\DomProbe('input[name="passwd"]',     80, '/administrator'),
        );
    }
}
