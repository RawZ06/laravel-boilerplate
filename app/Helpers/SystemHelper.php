<?php

if (! function_exists('includeFilesInFolder')) {
    /**
     * Loops through a folder and requires all PHP files
     * Searches subdirectories as well.
     */
    function includeFilesInFolder($folder): void
    {
        try {
            $rdi = new RecursiveDirectoryIterator($folder);
            $it = new RecursiveIteratorIterator($rdi);

            while ($it->valid()) {
                if (! $it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                    require $it->key();
                }

                $it->next();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

if (! function_exists('includeRouteFiles')) {

    function includeRouteFiles($folder): void
    {
        includeFilesInFolder($folder);
    }
}

if (! function_exists('image')) {
    function image(string $image, int $quality = 100): string
    {
        return config('image-api.host').'/api/file/'.$image.'?quality='.$quality;
    }
}
