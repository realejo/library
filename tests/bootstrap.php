<?php
$root = dirname(__DIR__);

set_include_path(implode(PATH_SEPARATOR, array(
    realpath($root . '/library'),
    get_include_path()
)));
unset($root);