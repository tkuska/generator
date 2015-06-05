<?php

namespace Tkuska\GeneratorBundle\Command;

use Sensio\Bundle\GeneratorBundle\Command\GenerateDoctrineCrudCommand as BaseGenerateDoctrineCrudCommand;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;
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
    
    protected function getSkeletonDirs(BundleInterface $bundle = null)
    {
        $skeletonDirs = array();

        if (isset($bundle) && is_dir($dir = $bundle->getPath().'/Resources/SensioGeneratorBundle/skeleton')) {
            $skeletonDirs[] = $dir;
        }

        if (is_dir($dir = $this->getContainer()->get('kernel')->getRootdir().'/Resources/SensioGeneratorBundle/skeleton')) {
            $skeletonDirs[] = $dir;
        }


        $bundleDirs = $this->getContainer()->get('kernel')
            ->locateResource('@SensioGeneratorBundle/Resources/skeleton', null, false);
        
        /*
         * Assert: $bundleDirs is an array that contains $sensioGeneratorSkeletonPath and maybe some more
         * Since $skeletonDirs is a prioritized list we want to exclude $sensioGeneratorSkeletonPath from $bundleDirs
         * now and make sure it is added at the end of the list.
         */
        foreach ($bundleDirs as $dir) {
                $skeletonDirs[] = $dir;
        }

        $skeletonDirs[] = __DIR__.'/../Resources';

        return $skeletonDirs;
    }

}
