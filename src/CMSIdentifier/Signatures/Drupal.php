<?php

namespace Arall\CMSIdentifier\Signatures;

use Arall\CMSIdentifier\Website;

class Drupal extends \Arall\CMSIdentifier\Signature
{
    /**
     * Product vendor
     *
     * @var string
     */
    protected $vendor = 'Drupal';

    /**
     * Product name
     *
     * @var string
     */
    protected $product = 'Drupal';

    /**
     * Construct
     *
     * @param Website $website
     */
    public function __construct(Website $website)
    {
        parent::__construct($website);

        $this->probes = array(
            new Probes\MetaGeneratorProbe($this->product, '/',                          80),
            new Probes\ContentStringProbe($this->product, '/CHANGELOG.txt',             100),
            new Probes\ContentStringProbe($this->product, '/misc/drupal.js',            100),
            new Probes\ResponseCodeProbe('/misc/druplicon.png', 200,                    100),
            new Probes\HeaderStringProbe('Sun, 19 Nov 1978 05:00:00 GMT',   'Expires',  60),
        );
    }
}
