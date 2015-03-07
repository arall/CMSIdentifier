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
    public $vendor = 'Drupal';

    /**
     * Product name
     *
     * @var string
     */
    public $product = 'Drupal';

    /**
     * Construct
     *
     * @param Website $website
     */
    public function __construct(Website $website)
    {
        parent::__construct($website);

        $this->probes = array(
            new Probes\MetaGeneratorProbe($this->product,                   80),
            new Probes\ContentStringProbe($this->product,                   100,    '/CHANGELOG.txt'),
            new Probes\ContentStringProbe($this->product,                   100,    '/misc/drupal.js'),
            new Probes\FileProbe('/misc/druplicon.png',                     100),
            new Probes\HeaderStringProbe('Sun, 19 Nov 1978 05:00:00 GMT',   60,     'Expires'),
        );
    }
}
