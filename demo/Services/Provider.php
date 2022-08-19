<?php

namespace Cspray\AnnotatedConsoleDemo\Services;

use Cspray\AnnotatedContainer\Attribute\Service;

#[Service]
interface Provider {

    public function get() : string;

}