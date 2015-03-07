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
            new Probes\ContentStringProbe('administrator',  10, '/robots.txt'),
            new Probes\ContentStringProbe('cache',          10, '/robots.txt'),
            new Probes\ContentStringProbe('images',         10, '/robots.txt'),
            new Probes\ContentStringProbe('media',          10, '/robots.txt'),
            new Probes\ContentStringProbe('components',     10, '/robots.txt'),
            new Probes\ContentStringProbe('includes',       10, '/robots.txt'),
            new Probes\ContentStringProbe('modules',        10, '/robots.txt'),
            new Probes\ContentStringProbe('plugins',        10, '/robots.txt'),
            new Probes\ContentStringProbe('templates',      10, '/robots.txt'),
            new Probes\DomProbe('input[name="passwd"]',     80, '/administrator'),
        );
    }
}
