<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Lock\Tests\Store;

/**
 * @author Jérémy Derussé <jeremy@derusse.com>
 *
 * @group integration
 */
class PredisStoreWithoutExceptionsTest extends AbstractRedisStoreTestCase
{
    public static function setUpBeforeClass(): void
    {
        $redis = new \Predis\Client(
            array_combine(['host', 'port'], explode(':', getenv('REDIS_HOST')) + [1 => null]),
            ['exceptions' => false],
        );
        try {
            $redis->connect();
        } catch (\Exception $e) {
            self::markTestSkipped($e->getMessage());
        }
    }

    protected function getRedisConnection(): \Predis\Client
    {
        $redis = new \Predis\Client(
            array_combine(['host', 'port'], explode(':', getenv('REDIS_HOST')) + [1 => null]),
            ['exceptions' => false],
        );
        $redis->connect();

        return $redis;
    }
}
