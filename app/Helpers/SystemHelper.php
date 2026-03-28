<?php

if (!function_exists('includeFilesInFolder')) {
    /**
     * Loops through a folder and requires all PHP files
     * Searches subdirectories as well.
     *
     * @param $folder
     */
    function includeFilesInFolder($folder): void
    {
        try {
            $rdi = new RecursiveDirectoryIterator($folder);
            $it = new RecursiveIteratorIterator($rdi);

            while ($it->valid()) {
                if (!$it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                    require $it->key();
                }

                $it->next();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

if (!function_exists('includeRouteFiles')) {

    /**
     * @param $folder
     */
    function includeRouteFiles($folder): void
    {
        includeFilesInFolder($folder);
    }
}

if (!function_exists('image')) {
    /**
     * @param string $image
     * @param int $quality
     * @return string
     */
    function image(string $image, int $quality = 100): string
    {
        return config('image-api.host').'/api/file/'.$image.'?quality='.$quality;
    }
}
