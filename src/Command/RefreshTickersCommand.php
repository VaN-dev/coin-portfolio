<?php

namespace App\Command;

use App\Service\Ticker\Refresher;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class RefreshTickersCommand
 * @package App\Command
 */
class RefreshTickersCommand extends Command
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var Refresher
     */
    private $refresher;

    public function __construct(EntityManagerInterface $em, Refresher $refresher)
    {
        $this->refresher = $refresher;
        $this->em = $em;

        parent::__construct();
    }

    /**
     * configure command.
     */
    protected function configure()
    {
        $this
            ->setName('app:refresh-tickers')
            ->setDescription('Refresh the tickers.')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $tickers = $this->refresher->refresh();

        $this->em->flush();

        $output->writeln('<fg=black;bg=green>                         </>');
        $output->writeln('<fg=black;bg=green> Refreshed '.count($tickers).' tickers. </>');
        $output->writeln('<fg=black;bg=green>                         </>');
    }
}
