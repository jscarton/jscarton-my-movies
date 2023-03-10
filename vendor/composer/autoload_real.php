<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitf981808b0f6abe3a425c669086d5b50a
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInitf981808b0f6abe3a425c669086d5b50a', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitf981808b0f6abe3a425c669086d5b50a', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitf981808b0f6abe3a425c669086d5b50a::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
