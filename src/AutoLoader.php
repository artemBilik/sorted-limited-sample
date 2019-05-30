<?php

namespace Travelata\ArtemBilik;


class AutoLoader
{
    public function register(): void
    {
        spl_autoload_register(function (string $class) {
            $class = str_replace(__NAMESPACE__, '', $class);
            $classFile = sprintf('%s%s.php', __DIR__, str_replace('\\', '/', $class));
            if (file_exists($classFile)) {
                require_once $classFile;
            }
        });
    }
}