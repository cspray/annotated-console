<?php

namespace Cspray\AnnotatedConsole;

use Cspray\AnnotatedConsole\Autowire\ApplicationCommandProvider;
use Cspray\AnnotatedContainer\Bootstrap\Bootstrap;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AnnotatedConsole {

    public function __construct(
        private readonly array $profiles = ['default'],
        private readonly ?Application $application = null
    ) {}

    public function run(InputInterface $input, OutputInterface $output = null) : int {
        $app = $this->application ?? new Application();
        $bootstrap = new Bootstrap();
        $bootstrap->addObserver(new ApplicationCommandProvider($app));
        $bootstrap->bootstrapContainer($this->profiles);

        $app->setAutoExit(false);

        return $app->run($input, $output);
    }

}