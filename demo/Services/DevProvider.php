<?php

namespace Cspray\AnnotatedConsoleDemo\Services;

use Cspray\AnnotatedContainer\Attribute\Service;

#[Service(profiles: ['dev'])]
final class DevProvider implements Provider {

    public function get() : string {
        return 'dev';
    }
}