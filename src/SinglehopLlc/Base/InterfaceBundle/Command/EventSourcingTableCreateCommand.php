<?php

namespace SinglehopLlc\Base\InterfaceBundle\Command;

use Prooph\EventStore\Stream;
use Prooph\EventStore\StreamName;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class EventSourcingTableCreateCommand
 * @package SinglehopLlc\Base\InterfaceBundle\Command
 */
class EventSourcingTableCreateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('event_stream:table:create')
            ->setDescription('Create an aggregateRoot event stream')
            ->addArgument('streamName', InputArgument::REQUIRED, 'event stream name')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $streamName = new StreamName($input->getArgument('streamName'));
        $eventStore = $this->getContainer()->get('prooph.pdo_event_store');
        $eventStore->create(new Stream($streamName, new \ArrayIterator()));
        $io = new SymfonyStyle($input, $output);
        $io->success(sprintf('stream %s was created', $streamName->toString()));
    }
}
