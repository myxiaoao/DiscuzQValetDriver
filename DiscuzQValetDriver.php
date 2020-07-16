<?php

class DiscuzQValetDriver extends LaravelValetDriver
{
    private function startsWith($haystack, $needle)
    {
        $length = strlen($needle);

        return (substr($haystack, 0, $length) === $needle);
    }

    public function serves($sitePath, $siteName, $uri)
    {
        return true;
    }

    public function isStaticFile($sitePath, $siteName, $uri)
    {
        if (file_exists($staticFilePath = $sitePath . '/public/' . $uri)) {
            return $staticFilePath;
        }

        if ($this->startsWith($uri, "/api")) {
            return false;
        }

        if ($this->startsWith($uri, "/install")) {
            return false;
        }

        if ($this->startsWith($uri, "/admin")) {
            return $sitePath . '/public/admin.html';
        }

        return $sitePath . '/public/index.html';
    }

    public function frontControllerPath($sitePath, $siteName, $uri)
    {
        if ($this->startsWith($uri, "/api")) {
            return $sitePath . '/public/index.php';
        }

        if ($this->startsWith($uri, "/install")) {
            return $sitePath . '/public/index.php';
        }

        if ($this->startsWith($uri, "/admin")) {
            return $sitePath . '/public/admin.html';
        }

        return $sitePath . '/public/index.html';
    }
}
