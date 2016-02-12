<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 01.07.2015
 * Time: 18:50
 */

namespace famoser\phpFrame\Views;

use Famoser\phpFrame\Core\Logging\LogHelper;

class GenericCrudView extends GenericView
{
    /**
     * GenericCrudView constructor.
     * @param string $controller
     * @param string $mode
     */
    public function __construct(string $controller, string $mode)
    {
        parent::__construct($controller, $mode, "_crud", true);
    }
}