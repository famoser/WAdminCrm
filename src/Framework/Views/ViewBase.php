<?php

/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 23.05.2015
 * Time: 14:14
 */
namespace famoser\phpFrame\Views;

class ViewBase
{
    /**
     * Enthält die Variablen, die in das Template eingebettet
     * werden sollen.
     */
    protected $_ = array();
    private $page_title = DEFAULTTITLE;
    private $page_description = DEFAULTDESCRIPTION;

    public function __construct($title = null, $description = null)
    {
        $this->params = unserialize(ACTIVE_PARAMS);

        if ($title != null)
            $this->page_title = $title;
        if ($description != null)
            $this->page_description = $description;
    }

    public function setPageTitle($title)
    {
        $this->page_title = $title;
    }

    public function setPageDescription($description)
    {
        $this->page_description = $description;
    }


    /**
     * Ordnet eine Variable einem bestimmten Schlüssel zu.
     *
     * @param String $key Schlüssel
     * @param String $value Variable
     */
    public function assign($key, $value)
    {
        $this->_[$key] = $value;
    }

    /**
     * loads the template
     */
    protected function loadFile($file)
    {
        ob_start();

        include $file;
        $output = ob_get_contents();
        $output = sanitize_output($output);
        ob_end_clean();

        return $output;
    }
}