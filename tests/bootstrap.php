<?php
/**
 * Realejo Lib Unit Test Bootstrap
 *
 * @category  TestUnit
 * @author    Realejo
 * @copyright Copyright (c) 2013 Realejo (http://realejo.com.br)
 */
namespace Realejo;

use RuntimeException;
error_reporting(E_ALL | E_STRICT);
chdir(__DIR__);

define('APPLICATION_ENV', 'testing');

/**
 * Test bootstrap, for setting up autoloading
 */
class Bootstrap
{

    protected static $serviceManager;

    public static function init()
    {
        static::initAutoloader();
    }

    public static function chroot()
    {
        $rootPath = dirname(static::findParentPath('module'));
        chdir($rootPath);
    }

    public static function getServiceManager()
    {
        return static::$serviceManager;
    }

    protected static function initAutoloader()
    {
        $vendorPath = static::findParentPath('vendor');

        $libraryPath = realpath($vendorPath . '/../library');
        if (file_exists($vendorPath . '/autoload.php')) {
            $loader = include $vendorPath . '/autoload.php';
        }
        set_include_path(implode(PATH_SEPARATOR, array(
            $libraryPath,
            get_include_path()
        )));
    }

    protected static function findParentPath($path)
    {
        $dir = __DIR__;
        $previousDir = '.';
        while (! is_dir($dir . '/' . $path)) {
            $dir = dirname($dir);
            if ($previousDir === $dir) {
                return false;
            }
            $previousDir = $dir;
        }
        return $dir . '/' . $path;
    }
}

Bootstrap::init();
