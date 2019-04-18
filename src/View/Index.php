<?php
declare(strict_types=1);
namespace Soatok\DholeCryptoWeb\View;

use Soatok\DholeCryptoWeb\Collection;
use Soatok\DholeCryptoWeb\View;

/**
 * Class Index
 * @package Soatok\DholeCryptoWeb\View
 */
class Index implements View
{
    public function __invoke(array $vars = []): string
    {
        return Collection::getTwig()->render('index.twig');
    }
}
