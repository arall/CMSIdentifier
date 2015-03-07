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

    public function getVersion()
    {
        $scores = array();
        $totals = array();
        $best = array('score' => 0, 'version' => null);

        $conditions = array(
            '1.0.x' => array(
                new Probes\StringProbe('/* OpenID icon style */', 100),
                new Probes\StringProbe('* @copyright Copyright (C) 2005 – 2010 Open Source Matters.', 100, '/templates/system/css/template.css'),
            ),
            '1.5' => array(
                new Probes\StringProbe('MooTools={version:\'1.12\'}', 100, '/media/system/js/mootools-more.js'),
            ),
            '1.5.26' => array(
                new Probes\StringProbe('# $Id: en-GB.ini 11391 2009-01-04 13:35:50Z ian $', 100, '/language/en-GB/en-GB.ini'),
            ),
            '1.6' => array(
                new Probes\StringProbe('MooTools.More={version:"1.3.0.1"', 100, '/media/system/js/mootools-more.js'),
            ),
            '1.6.0' => array(
                new Probes\StringProbe('; $Id: en-GB.ini 20196 2011-01-09 02:40:25Z ian $', 100, '/language/en-GB/en-GB.ini'),
            ),
            '1.6.5' => array(
                new Probes\StringProbe('; $Id: en-GB.ini 20990 2011-03-18 16:42:30Z infograf768 $', 100, '/language/en-GB/en-GB.ini'),
            ),
            '1.7' => array(
                new Probes\StringProbe('MooTools.More={version:"1.3.2.1"', 100, '/media/system/js/mootools-more.js'),
            ),
            '1.7.1' => array(
                new Probes\StringProbe('; $Id: en-GB.ini 20990 2011-03-18 16:42:30Z infograf768 $', 100, '/language/en-GB/en-GB.ini'),
            ),
            '1.7.3' => array(
                new Probes\StringProbe('; $Id: en-GB.ini 22183 2011-09-30 09:04:32Z infograf768 $', 100, '/language/en-GB/en-GB.ini'),
            ),
            '1.7.5' => array(
                new Probes\StringProbe('; $Id: en-GB.ini 22183 2011-09-30 09:04:32Z infograf768 $', 100, '/language/en-GB/en-GB.ini'),
            ),
            '2.5.x' => array(
                new Probes\StringProbe('2.5.0', 100, '/language/en-GB/en-GB.xml'),
            ),
            '2.5.6' => array(
                new Probes\StringProbe('MooTools.More={version:"1.4.0.1"', 100, '/media/system/js/mootools-more.js'),
            ),
            '3.0' => array(
                new Probes\StringProbe('MooTools.More={version:"1.4.0.1"', 100, '/media/system/js/mootools-more.js'),
            ),
        );

        foreach ($conditions as $version => $probes) {
            foreach ($probes as $probe) {
                $scores[$version] = 0;
                $totals[$version] = 0;
                if ($probe->run($this->website)) {
                    $scores[$version] += $probe->score;
                }
                $totals[$version] += $probe->score;
            }
            $score = $scores[$version] / $totals[$version];
            if ($best['score'] <= $score) {
                $best = array('score' => $score, 'version' => $version);
            }
        }

        return $best['score'] ? $best['version'] : false;
    }
}
