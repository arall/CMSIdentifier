<?php

namespace Arall\CMSIdentifier\Signatures\Probes;

abstract class BooleanProbe
{
    public $score = 0;

    public function run()
    {
        return true;
    }
}
