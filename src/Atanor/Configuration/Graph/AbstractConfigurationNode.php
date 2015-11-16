<?php
declare(strict_types = 1);
namespace Atanor\Configuration\Graph;

use Atanor\Configuration\Configuration;
use Atanor\Configuration\Graph;

abstract class AbstractConfigurationNode implements ConfigurationNode
{
    /**
     * Node path
     * @var string
     */
    protected $path;

    /**
     * Data
     * @var array
     */
    protected $data =[];

    /**
     * Parent node
     * @var ConfigurationNode
     */
    protected $parent;

    /**
     * @inheritdoc
     */
    public function getParent():ConfigurationNode
    {
        return $this->parent;
    }

    /**
     * @inheritdoc
     */
    public function setParent(ConfigurationNode $parent):ConfigurationNode
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * @param $key
     * @param $value
     * @return ConfigurationNode
     */
    public function setData($key,$value):ConfigurationNode
    {
        $this->data[$key] = $value;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function toArray():array
    {
        $configurationArray = [];
        foreach($this->data as $key => $value) {
            if ($value instanceof Configuration) {
                $value = $value->toArray();
            }
            if (is_array($value)) {
                foreach($value as $subKey => &$subValue){
                    if ($subValue instanceof Configuration) {
                        $subValue = $subValue->toArray();
                    }
                }
            }
            $configurationArray[$key] = $value;
        }
        return $configurationArray;
    }

    /**
     * @inheritDoc
     */
    public function getPath():string
    {
        return $this->path;
    }

    /**
     * @inheritDoc
     */
    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset)
    {
        return $this->data[$offset];
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value)
    {
        $this->data[$offset] = $value;
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        return $this->data;
    }

}