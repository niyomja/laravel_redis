<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Process\Tests;

use Symfony\Component\Process\PhpExecutableFinder;

/**
 * @author Robert Schönthal <seroscho@googlemail.com>
 */
class PhpExecutableFinderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * tests find() with the env var PHP_PATH.
     */
    public function testFindWithHHVM()
    {
        if (!defined('HHVM_VERSION')) {
            $this->markTestSkipped('Should be executed in HHVM context.');
        }

        $f = new PhpExecutableFinder();

        $current = getenv('PHP_BINARY') ?: PHP_BINARY;

        $this->assertEquals($current.' --php', $f->find(), '::find() returns the executable PHP');
        $this->assertEquals($current, $f->find(false), '::find() returns the executable PHP');
    }

    /**
     * tests find() with the env var PHP_PATH.
     */
    public function testFindArguments()
    {
        $f = new PhpExecutableFinder();

        if (defined('HHVM_VERSION')) {
            $this->assertEquals($f->findArguments(), array('--php'), '::findArguments() returns HHVM arguments');
        } else {
            $this->assertEquals($f->findArguments(), array(), '::findArguments() returns no arguments');
        }
    }
}
