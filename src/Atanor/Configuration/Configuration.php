<?php
declare(strict_types=1);
namespace Atanor\Configuration;

interface Configuration extends \ArrayAccess, \IteratorAggregate
{
    /**
     * Return configuration as array
     * @return array
     */
    public function toArray():array;
}
