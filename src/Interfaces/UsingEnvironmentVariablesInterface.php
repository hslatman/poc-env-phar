<?php
/**
 * Author: Herman Slatman
 * Date: 03/08/2018
 * Time: 10:36
 */

namespace EnvPhar\Interfaces;

interface UsingEnvironmentVariablesInterface
{
    /**
     * @return string[] An array of environment variables
     */
    public function getRequiredEnvironmentVariables() : array;
}