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
    protected $vendor = 'Joomla';

    /**
     * Product name
     *
     * @var string
     */
    protected $product = 'Joomla';

    /**
     * Construct
     *
     * @param Website $website
     */
    public function __construct(Website $website)
    {
        parent::__construct($website);

        $this->probes = array(
            new Probes\MetaGeneratorProbe($this->product,   '/',                100),
            new Probes\ContentStringProbe('administrator',  '/robots.txt',      10),
            new Probes\ContentStringProbe('cache',          '/robots.txt',      10),
            new Probes\ContentStringProbe('images',         '/robots.txt',      10),
            new Probes\ContentStringProbe('media',          '/robots.txt',      10),
            new Probes\ContentStringProbe('components',     '/robots.txt',      10),
            new Probes\ContentStringProbe('includes',       '/robots.txt',      10),
            new Probes\ContentStringProbe('modules',        '/robots.txt',      10),
            new Probes\ContentStringProbe('plugins',        '/robots.txt',      10),
            new Probes\ContentStringProbe('templates',      '/robots.txt',      10),
            new Probes\DomProbe('input[name="passwd"]',     '/administrator',   80),
        );
    }

    public function getVersion()
    {
        $scores = array();
        $totals = array();
        $best = array('score' => 0, 'version' => null);

        $conditions = array(
            '1.0.x' => array(
                new Probes\ContentStringProbe('/* OpenID icon style */', '/', 100),
                new Probes\ContentStringProbe('* @copyright Copyright (C) 2005 – 2010 Open Source Matters.', '/templates/system/css/template.css', 100),
            ),
            '1.5' => array(
                new Probes\ContentStringProbe('MooTools={version:\'1.12\'}', '/media/system/js/mootools-more.js', 100),
            ),
            '1.5.26' => array(
                new Probes\ContentStringProbe('# $Id: en-GB.ini 11391 2009-01-04 13:35:50Z ian $', '/language/en-GB/en-GB.ini', 100),
            ),
            '1.6' => array(
                new Probes\ContentStringProbe('MooTools.More={version:"1.3.0.1"', '/media/system/js/mootools-more.js', 100),
            ),
            '1.6.0' => array(
                new Probes\ContentStringProbe('; $Id: en-GB.ini 20196 2011-01-09 02:40:25Z ian $', '/language/en-GB/en-GB.ini', 100),
            ),
            '1.6.5' => array(
                new Probes\ContentStringProbe('; $Id: en-GB.ini 20990 2011-03-18 16:42:30Z infograf768 $', '/language/en-GB/en-GB.ini', 100),
            ),
            '1.7' => array(
                new Probes\ContentStringProbe('MooTools.More={version:"1.3.2.1"', '/media/system/js/mootools-more.js', 100),
            ),
            '1.7.1' => array(
                new Probes\ContentStringProbe('; $Id: en-GB.ini 20990 2011-03-18 16:42:30Z infograf768 $', '/language/en-GB/en-GB.ini', 100),
            ),
            '1.7.3' => array(
                new Probes\ContentStringProbe('; $Id: en-GB.ini 22183 2011-09-30 09:04:32Z infograf768 $', '/language/en-GB/en-GB.ini', 100),
            ),
            '1.7.5' => array(
                new Probes\ContentStringProbe('; $Id: en-GB.ini 22183 2011-09-30 09:04:32Z infograf768 $', '/language/en-GB/en-GB.ini', 100),
            ),
            '2.5.x' => array(
                new Probes\ContentStringProbe('2.5.0', '/language/en-GB/en-GB.xml', 100),
            ),
            '2.5.6' => array(
                new Probes\ContentStringProbe('MooTools.More={version:"1.4.0.1"', '/media/system/js/mootools-more.js', 100),
            ),
            '3.0' => array(
                new Probes\ContentStringProbe('MooTools.More={version:"1.4.0.1"', '/media/system/js/mootools-more.js', 100),
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
