<?php

namespace Tkuska\GeneratorBundle\Command;

use Sensio\Bundle\GeneratorBundle\Command\GenerateDoctrineCrudCommand as BaseGenerateDoctrineCrudCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\ArrayInput;

/**
 * Generates a CRUD for a Doctrine entity.
 *
 * @author Tomasz Kuśka <tomasz.kuska@gmail.com>
 */
class GenerateDoctrineCrudCommand extends BaseGenerateDoctrineCrudCommand {

    protected function execute(InputInterface $input, OutputInterface $output) {
        parent::execute($input, $output);

        $command = $this->getApplication()->find('sg:datatable:generate');

        $arguments = array(
            'command' => 'sg:datatable:generate',
            'entity' => $input->getOption('entity')
        );

        $commandInput = new ArrayInput($arguments);
        $returnCode = $command->run($commandInput, $output);
    }

}
