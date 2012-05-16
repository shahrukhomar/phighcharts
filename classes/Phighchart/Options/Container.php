<?php

namespace Phighchart\Options;

/**
 * Container for Phighchart Options section
 * There will generally be multiple instances of this Container passed into
 * a single Chart
 * @author Chris Sedlmayr catchamonkey <chris@sedlmayr.co.uk>
 */
class Container
{
    /**
     * The type of options being created (a section within highcharts options)
     */
    private $_type;
    private $_options;

    public function __construct($type = null)
    {
        $this->_type    = $type;
        $this->_options = new \StdClass();
    }

    /**
     * Returns the type of options you are defining
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * This function is designed to catch setter function calls
     * (methods starting with set), and uses the function name as the key you
     * are setting, e.g. setMargin(10) becomes margin:10
     * @param String $name the name of the method being called.
     * @param Array  $arguments an enumerated array containing the parameters
     * passed to the $name'ed method.
     */
    public function __call($name, Array $arguments)
    {
        // if the call starts with set, it is an option setting call so extract
        // the remaining part as the key
        if (substr($name, 0, 3) == 'set') {
            $key = lcfirst(substr($name, 3));
            $this->setOption($key, $arguments[0]);
        }
    }

    public function setOption($key, $value)
    {
        $this->_options->$key = $value;
    }

    public function getOptions()
    {
        return $this->_options;
    }
}