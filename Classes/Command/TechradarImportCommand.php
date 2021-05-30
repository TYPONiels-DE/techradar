<?php

namespace TN\Techradar\Command;

use Symfony\Component\Console\Command\Command as Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use TN\Techradar\Service\DataImportService;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class TechradarImporter
 * @package TN\Techradar\Command
 */
class TechradarImportCommand extends Command
{
    /**
     * Configure the command by defining the name, options and arguments
    */
    protected function configure(): void
    {
        $this->setName('TYPONiels')->setDescription('Import Items from Techradar (Cockpit CMS)');
    }

    /**
     * Executes the command for importing cockpit data
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int error code
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /* @var ExtensionConfiguration $extensionConfiguration */
        $extensionConfiguration = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('techradar');

        $io = new SymfonyStyle($input, $output);
        $io->title($this->getName());

        $io->writeln('Start Import from Cockpit CMS');
        $importService = GeneralUtility::makeInstance(DataImportService::class);
        $import = $importService->importFromCLI($extensionConfiguration);
        $io->writeln($import);
        if($import == 0) {
            $io->writeln('Import was successfull');
        } else {
            throw new \Exception('Something gone wrong while import data from Cockpit');
        }
        return 0;
    }
}