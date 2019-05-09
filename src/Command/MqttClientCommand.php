<?php

namespace App\Command;

use oliverlorenz\reactphpmqtt\ClientFactory;
use oliverlorenz\reactphpmqtt\packet\Publish;
use oliverlorenz\reactphpmqtt\protocol\Version4;
use Ratchet\Client\WebSocket;
use React\Dns\Resolver\Factory;
use React\Socket\DnsConnector;
use React\Socket\SecureConnector;
use React\Socket\TcpConnector;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use React\Socket\ConnectionInterface as Stream;
use React\Socket\ConnectionInterface as Connection;

class MqttClientCommand extends Command
{
    protected static $defaultName = 'mqtt:client:run';

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
//        $arg1 = $input->getArgument('arg1');
//
//        if ($arg1) {
//            $io->note(sprintf('You passed an argument: %s', $arg1));
//        }
//
//        if ($input->getOption('option1')) {
//            // ...
//        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        $client = ClientFactory::createClient(new Version4(), '8.8.8.8');

        $p = $client->connect('192.168.1.10:1883');
        $p->then(function (Stream $stream) use ($client) {
            $stream->on(Publish::EVENT, function (Publish $message) {
                printf(
                    'Received payload "%s" for topic "%s"%s',
                    $message->getPayload(),
                    $message->getTopic(),
                    PHP_EOL
                );
            });

            $client->subscribe($stream, 'test', 0);
        });

        $client->getLoop()->run();

    }
}
