# Annotated Console

Annotated Console is a way to autowire and configure [symfony/console](https://github.com/symfony/console) applications using [Annotated Container](https://github.com/cspray/annotated-container). Out of the box, Annotated Console is intended to provide the following features:

- Automatically add Command instances to a Symfony Application.
- Allow configuring a Command using PHP 8 Attributes.
- Depend on services in Command constructors and take advantage of other functionality provided by [Annotated Container](https://github.com/cspray/annotated-container).

## Installation

I recommend installing Annotated Console using [Composer](https://getcomposer.org).

```shell
composer require cspray/annotated-console:dev-main cspray/annotated-container:v2.x-dev
```

> Annotated Console currently requires Annotated Container v2.x-dev. When Annotated Container releases 2.0 this library 
> will release a 1.0 package.

## Quick Start

Annotated Console is designed to get going in a few straightforward steps.

## Step 1 - Initiate your Container

The functionality for this library is primarily provided by [Annotated Container](https://github.com/cspray/annotated-container). Which means you need to make sure that your configuration is setup to boostrap your app. As long as you have a PSR-4 or PSR-0 autoload configuration setup in your `composer.json` you can run the following command from the root of your project:

```shell
./vendor/bin/annotated-container init
```

By default, the init command will create a directory to cache your Container so static analysis doesn't have to run on every Command. Early in development it is advised to disable the cache by removing the `<cacheDir>` element from the configuration file. It is important that if new Services or Commands are added the Container cache is busted appropriately.

## Step 2 - Create your App's Binary

Next, you'll need to create the file that you'll use to run your app. You can name and store this file anywhere you'd like, but we'll put our example in `./bin/acme`.

```php
#!/usr/bin/env php
<?php declare(strict_types=1);

use Cspray\AnnotatedConsole\AnnotatedConsole;
use Symfony\Component\Console\Input\ArgvInput;

require_once dirname(__DIR__) . '/vendor/autoload.php';

// Customize this as appropriate for your installation. Please check out Annotated Container docs for more information
// If your list of profiles only ever includes 'default' you can skip over providing $profiles completely
$profiles = ['default'];
$exitCode = (new AnnotatedConsole(profiles: $profiles))->run(new ArgvInput());
exit($exitCode);
```

After you've added this script ensure you run `chmod +x ./bin/acme` so that you can execute it!

## Step 3 - Add your Commands

At this point you're ready to start adding Commands! Anywhere in a directory scanned by Annotated Container, this will be defined in the `annotated-container.xml` file created in Step 1, implement an object that extends Command and is controlled by the Container.

```php
<?php declare(strict_types=1);

namespace Acme\Demo;

use Symfony\Component\Console\Command\Command;
use Cspray\AnnotatedConsole\Attribute\ConsoleCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[ConsoleCommand('hello-world')]
class HelloWorld extends Command {

    protected function execute(InputInterface $input, OutputInterface $output) {
        $output->writeln('Hello, world!');
    }

}
```

Now, if you run `./bin/acme hello-world` your Command will be executed!

You can configure the bulk of your Command through the ConsoleCommand Attribute. Check out the `demo` directory for 
more examples, including configuring arguments and options.