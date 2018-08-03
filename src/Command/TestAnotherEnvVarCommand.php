<?php
/**
 * Author: Herman Slatman
 * Date: 03/08/2018
 * Time: 11:14
 */

namespace EnvPhar\Command;


use EnvPhar\Interfaces\UsingEnvironmentVariablesInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestAnotherEnvVarCommand extends Command implements UsingEnvironmentVariablesInterface
{
    private $required_environment_variables = [
        'TEST_ANOTHER_ENV_VAR'
    ];

    protected static $defaultName = 'env-phar:test-another';

    protected function configure()
    {
        $this
            ->setDescription('POC for ENV VARS with Phars')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        var_dump(getenv('TEST_ANOTHER_ENV_VAR'));
    }

    public function getRequiredEnvironmentVariables(): array
    {
        return $this->required_environment_variables;
    }
}