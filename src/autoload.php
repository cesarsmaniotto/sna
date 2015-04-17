<?php

function autoloadConfig() {
    $inc_dirs = get_include_path();
    $inc_dirs = $inc_dirs . PATH_SEPARATOR . __DIR__;
    set_include_path($inc_dirs);
    spl_autoload_extensions(".php");
    spl_autoload_register();
}


autoloadConfig();