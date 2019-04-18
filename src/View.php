<?php
declare(strict_types=1);
namespace Soatok\DholeCryptoWeb;

/**
 * Interface View
 * @package Soatok\DholeCryptoWeb
 */
interface View
{
    /**
     * @param array $vars
     * @return string
     */
    public function __invoke(array $vars = []): string;
}
