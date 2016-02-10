<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 01.07.2015
 * Time: 18:12
 */ ?>

<?php if (CanAccessAnyMenu()) { ?>

<div class="primary-menu clearfix" >
    <div class="primary-menu-items" >
        <ul class="tiles" >
            <?php
            $controllers = json_decode(CONTROLLERS);
            foreach ($controllers as $controller) {
                if (CanAccessGenericController($controller)) {
                    ?>
                    <li <?php echo GetClassesForMenuItem($this, array($controller->url)); ?>>
                        <a href="<?php echo $controller->url ?>/">
                            <span class="<?php echo $controller->icon ?>"
                                  aria-hidden="true"></span><?php echo $controller->name ?>
                        </a>
                    </li>
                <?php }
            } ?>
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
<?php } ?>

<?php if ($this->submenu != null) {
    ?>
    <div class="submenu-items">
        <ul class="oneline-nav">
            <?php
            foreach ($this->submenu as $menuitem) {
                $href = $menuitem["href"];
                if ($href != "" && !str_ends_with($href, "/"))
                    $href .= "/";

                echo '<li ' . GetClassesForMenuItem($this, array($this->params[0], $menuitem["href"]), true) . '>
                            <a href="' . $this->controller . "/" . $href . '">' . $menuitem["content"] . '</a>
                      </li>';
            }
            ?>
        </ul>
    </div>
<?php } ?>
