<?php
/**
 * Copyright © 2023 Labofgood. All rights reserved.
 * See COPYING.txt for license details.
 *
 * @author    Anton Abramchenko <anton.abramchenko@labofgood.com>
 * @copyright 2023 Labofgood
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
declare(strict_types=1);

namespace Labofgood\EngraveProduct\Console\Command;

use Magento\Framework\App\Area;
use Magento\Framework\App\State;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyleFactory;
use Labofgood\EngraveProduct\Api\OrderStatisticOptionInterfaceFactory;
use Labofgood\EngraveProduct\Api\OrderStatisticCollectorInterfaceFactory;

/**
 * Class OrderStatisticCommand
 *
 * Command provided statistics on orders that have an engraving flag and have not yet been shipped.
 */
class OrderStatisticCommand extends Command
{
    /**
     * List of command arguments
     */
    private const IS_ENGRAVED = 'is_engraved';
    private const NOT_SHIPPED = 'is_not_shipped';

    /**
     * @param State $state
     * @param OrderStatisticOptionInterfaceFactory $statisticOptionFactory
     * @param OrderStatisticCollectorInterfaceFactory $statisticCollectorFactory
     * @param SymfonyStyleFactory $styleFactory
     * @param string|null $name
     */
    public function __construct(
        private readonly State $state,
        private readonly OrderStatisticOptionInterfaceFactory $statisticOptionFactory,
        private readonly OrderStatisticCollectorInterfaceFactory $statisticCollectorFactory,
        private readonly SymfonyStyleFactory $styleFactory,
        string $name = null
    ) {
        parent::__construct($name);
    }

    /**
     * Initialization of the command.
     */
    protected function configure()
    {
        $this->setName('labofgood:statistic:orders');
        $this->setDescription(
            'This command provides statistics on orders that have an engraving flag
             and have not yet been shipped.'
        );

        $this->addOption(
            self::IS_ENGRAVED,
            null,
            InputOption::VALUE_OPTIONAL,
            'Provides statistics on orders that have an engraving flag.'
        );

        $this->addOption(
            self::NOT_SHIPPED,
            null,
            InputOption::VALUE_OPTIONAL,
            'Provides statistics on orders that have been not shipped yet.'
        );

        $this->setHelp(
            <<<HELP
Example:
    --is_engraved - provides statistics on orders that have an engraving flag.
    --is_not_shipped - provides statistics on orders that have been not shipped yet.
<comment>php bin/magento labofgood:statistic:orders --is_engraved=1 --is_not_shipped=1</comment>
HELP
        );

        parent::configure();
    }

    /**
     * CLI command description.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->state->emulateAreaCode(
            Area::AREA_FRONTEND,
            [$this, 'getStatistic'],
            [$input, $output]
        );

        return 0;
    }

    /**
     * Get orders statistic by provided options.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return void
     */
    public function getStatistic(InputInterface $input, OutputInterface $output): void
    {
        $styledIo = $this->styleFactory->create(
            [
                'input' => $input,
                'output' => $output
            ]
        );

        try {
            $statisticOption = $this->statisticOptionFactory->create(
                [
                    'isEngraved' => (bool) $input->getOption(self::IS_ENGRAVED),
                    'isNotShipped' => (bool) $input->getOption(self::NOT_SHIPPED)
                ]
            );

            $statisticCollector = $this->statisticCollectorFactory->create(
                [
                    'statisticOption' => $statisticOption
                ]
            );

            $styledIo->success('Amount of orders: ' . $statisticCollector->execute());
        } catch (\Throwable $exception) {
            $styledIo->error($exception->getMessage());
            $styledIo->error($exception->getTraceAsString());
        }
    }
}
