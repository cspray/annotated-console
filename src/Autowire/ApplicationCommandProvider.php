<?php

namespace Cspray\AnnotatedConsole\Autowire;

use Cspray\AnnotatedConsole\Attribute\ConsoleCommand;
use Cspray\AnnotatedContainer\AnnotatedContainer;
use Cspray\AnnotatedContainer\Bootstrap\Observer;
use Cspray\AnnotatedContainer\ContainerDefinition;
use ReflectionClass;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;

class ApplicationCommandProvider implements Observer {

    private readonly ConsoleCommandAttributeConfigurator $configurator;

    public function __construct(private readonly Application $application) {
        $this->configurator = new ConsoleCommandAttributeConfigurator();
    }

    public function beforeCompilation() : void {
        // noop
    }

    public function afterCompilation(ContainerDefinition $containerDefinition) : void {
        // noop
    }

    public function beforeContainerCreation(ContainerDefinition $containerDefinition) : void {
        // noop
    }

    public function afterContainerCreation(ContainerDefinition $containerDefinition, AnnotatedContainer $container) : void {
        foreach ($containerDefinition->getServiceDefinitions() as $serviceDefinition) {
            if ($serviceDefinition->isAbstract()) {
                continue;
            }

            if (is_subclass_of($serviceDefinition->getType()->getName(), Command::class)) {
                $command = $container->get($serviceDefinition->getType()->getName());
                $reflectionAttribute = (new ReflectionClass($serviceDefinition->getType()->getName()))->getAttributes(ConsoleCommand::class)[0] ?? null;
                if ($reflectionAttribute !== null) {
                    $attribute = $reflectionAttribute->newInstance();
                    assert($attribute instanceof ConsoleCommand);
                    $this->configurator->configure($command, $attribute);
                }


                $this->application->add($command);
            }
        }
    }
}