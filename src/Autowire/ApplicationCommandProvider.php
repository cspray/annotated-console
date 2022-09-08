<?php

namespace Cspray\AnnotatedConsole\Autowire;

use Cspray\AnnotatedConsole\Attribute\ConsoleCommand;
use Cspray\AnnotatedContainer\AnnotatedContainer;
use Cspray\AnnotatedContainer\Bootstrap\ServiceGatherer;
use Cspray\AnnotatedContainer\Bootstrap\ServiceWiringObserver;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;

class ApplicationCommandProvider extends ServiceWiringObserver {

    private readonly ConsoleCommandAttributeConfigurator $configurator;

    public function __construct(private readonly Application $application) {
        $this->configurator = new ConsoleCommandAttributeConfigurator();
    }

    protected function wireServices(AnnotatedContainer $container, ServiceGatherer $gatherer) : void {
        foreach ($gatherer->getServicesForType(Command::class) as $serviceAndDefinition) {
            $command = $serviceAndDefinition->getService();
            assert($command instanceof Command);
            $attribute = $serviceAndDefinition->getDefinition()->getAttribute();

            if ($attribute instanceof ConsoleCommand) {
                $this->configurator->configure($command, $attribute);
            }

            $this->application->add($command);
        }
    }
}