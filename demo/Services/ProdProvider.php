<?php

namespace Cspray\AnnotatedConsoleDemo\Services;

use Cspray\AnnotatedContainer\Attribute\Service;

#[Service(profiles: ['prod'])]
class ProdProvider implements Provider {

    public function get() : string {
        return 'prod';
    }
}