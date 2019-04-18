<?php
declare(strict_types=1);
namespace Soatok\DholeCryptoWeb;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/**
 * Class Collection
 * @package Soatok\DholeCryptoWeb
 */
class Collection
{

    /**
     * @param string $path
     *
     * @return string
     */
    public static function mimeType(string $path): string
    {
        if (\preg_match('/\.css$/', $path)) {
            return 'text/css; charset=UTF-8';
        }
        if (\preg_match('/\.js$/', $path)) {
            return 'application/javascript; charset=UTF-8';
        }
        if (\is_callable('mime_content_type')) {
            $type = \mime_content_type($path);
            // TODO: Whitelist
        } else {
            $type = 'text/plain; charset=UTF-8';
        }
        return $type;
    }

    /**
     * @param string $path
     * @return bool
     */
    public static function isStaticResource(string $path): bool
    {
        if (empty($path) || \is_dir($path)) {
            return false;
        }
        if ($path === SOATOK_WEB_ROOT) {
            return false;
        }
        if (!\file_exists($path)) {
            return false;
        }
        if (!\is_readable($path)) {
            return false;
        }
        $pos = \strpos($path, SOATOK_WEB_ROOT);
        if ($pos !== 0) {
            // Directory traversal attempt
            false;
        }
        return true;
    }

    /**
     * @return Environment
     */
    public static function getTwig(): Environment
    {
        $env = static::getTwigEnvironment();
        $ansi = file_get_contents(
            dirname(__DIR__) . '/public/dhole-ansi.txt'
        );
        $env->addGlobal('ansi_dhole', $ansi);
        return $env;
    }

    /**
     * @return Environment
     */
    public static function getTwigEnvironment(): Environment
    {
        $loader = new FilesystemLoader([
            dirname(__DIR__) . '/template'
        ]);
        return new Environment($loader, ['autoescape' => 'html_attr']);
    }
}
