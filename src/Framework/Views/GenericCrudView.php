<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 01.07.2015
 * Time: 18:50
 */

namespace famoser\phpFrame\Views;

use Famoser\phpFrame\Core\Logging\Logger;

class GenericCrudView extends GenericView
{
    protected $link;
    protected $folder;
    protected $replaces;

    const CRUD_CREATE = 1;
    const CRUD_READ = 2;
    const CRUD_UPDATE = 3;
    const CRUD_DELETE = 4;

    const CRUD_GENERIC_DELETE = 14;

    public function __construct($controller, $mode, array $replaces = null)
    {
        if ($mode >= 10) {
            $mode -= 10;
            parent::__construct("GenericController", $this->getFilenameFromMode($this->getMode($mode, $replaces)), "_crud", true);
        } else {
            parent::__construct($controller, $this->getFilenameFromMode($this->getMode($mode, $replaces)), "_crud");
        }
    }

    private function getMode($mode, $replaces)
    {
        if ($replaces != null && is_array($replaces) && isset($replaces[$mode]))
            return $replaces[$mode];
        else
            return $mode;
    }

    private function getFilenameFromMode($mode)
    {
        if ($mode == GenericCrudView::CRUD_CREATE)
            return "create";
        else if ($mode == GenericCrudView::CRUD_READ)
            return "read";
        else if ($mode == GenericCrudView::CRUD_UPDATE)
            return "update";
        else if ($mode == GenericCrudView::CRUD_DELETE)
            return "delete";
        else
            Logger::getInstance()->logFatal("Invalid crud action! Please use one of the constants in GenericCrudView");
        return "";
    }
}