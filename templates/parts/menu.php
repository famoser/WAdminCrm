<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 01.07.2015
 * Time: 18:12
 */ ?>

<div class="primary-menu clearfix">
    <div class="primary-menu-items">
        <ul class="tiles">
            <li <?php echo GetClassesForMenuItem($this, array("customers")); ?>>
                <a href="customers/">
                    <span class="flaticon-profile29" aria-hidden="true"></span>Customers
                </a>
            </li>
            <li <?php echo GetClassesForMenuItem($this, array("projects")); ?>>
                <a href="projects/">
                    <span class="flaticon-notes26" aria-hidden="true"></span>Projects
                </a>
            </li>
            <li <?php echo GetClassesForMenuItem($this, array("milestones")); ?>>
                <a href="milestones/">
                    <span class="flaticon-notes27" aria-hidden="true"></span>Milestones
                </a>
            </li>
            <li <?php echo GetClassesForMenuItem($this, array("procedures")); ?>>
                <a href="procedures/">
                    <span class="flaticon-sheet3" aria-hidden="true"></span>Procedures
                </a>
            </li>
            <li <?php echo GetClassesForMenuItem($this, array("settings")); ?>>
                <a href="settings/">
                    <span class="flaticon-screwdriver26" aria-hidden="true"></span>Einstellungen
                </a>
            </li>
        </ul>
    </div>

    <div class="secondary-menu-items">
        <ul class="tiles">
            <li>
                <a class="tile floatright" href="logout">
                    <span class="flaticon-cancel22" aria-hidden="true"></span>Logout
                </a>
            </li>
        </ul>
    </div>
</div>

<?php if ($this->submenu != null) {
    ?>
    <div class="submenu-items">
        <ul class="oneline-nav">
            <?php
            foreach ($this->submenu as $menuitem) {
                $href = $menuitem["href"];
                if ($href != "" && !str_endsWith($href, "/"))
                    $href .= "/";

                echo '<li ' . GetClassesForMenuItem($this, array($this->params[0], $menuitem["href"]), true) . '>
                            <a href="' . $this->controller . "/" . $href . '">' . $menuitem["content"] . '</a>
                      </li>';
            }
            ?>
        </ul>
    </div>
<?php } ?>
