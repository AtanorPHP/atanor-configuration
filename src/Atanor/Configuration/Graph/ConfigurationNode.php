<?php
declare(strict_types = 1);
namespace Atanor\Configuration\Graph;

use Atanor\Configuration\Configuration;

interface ConfigurationNode extends Configuration
{
    /**
     * Returns node path
     * @return string
     */
    public function getPath():string;

    /**
     * Return parent configuration node
     * @return ConfigurationNode
     */
    public function getParent():ConfigurationNode;

    /**
     * Set parent configuration node
     * @param ConfigurationNode $configurationNode
     * @return ConfigurationNode
     */
    public function setParent(ConfigurationNode $configurationNode):ConfigurationNode;
}