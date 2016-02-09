<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 09.02.2016
 * Time: 14:54
 */

namespace famoser\phpFrame\Views;


use famoser\phpFrame\Models\View\MenuItem;

class MenuView extends ViewBase
{
    private $subMenu;

    public function __construct(array $subMenu = null)
    {
        parent::__construct();
        if ($subMenu == null)
            $this->subMenu = array();
        else
            $this->subMenu = $subMenu;
    }

    /**
     * @param MenuItem[] $menuItems
     */
    public function setSubMenu(array $menuItems)
    {
        $this->subMenu = $menuItems;
    }

    /**
     * @param MenuItem $menuItem
     * @param bool $appendAtStart
     */
    public function addSubMenuEntry(MenuItem $menuItem, $appendAtStart = false)
    {
        if ($appendAtStart) {
            $mainArr = array();
            $mainArr[] = $menuItem;
            array_push($mainArr, $this->subMenu);
        } else {
            $this->subMenu[] = $menuItem;
        }
    }

    /**
     * @return MenuItem[] menuItems
     */
    public function getMenuItems()
    {
        return $this->subMenu;
    }
}