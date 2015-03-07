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
            new Probes\MetaGeneratorProbe($this->product, 100),
            new Probes\StringProbe($this->product,        100, '/CHANGELOG.txt'),
            new Probes\StringProbe($this->product,        100, '/misc/drupal.js'),
        );
    }
}
