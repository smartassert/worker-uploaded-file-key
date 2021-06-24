<?php

declare(strict_types=1);

namespace SmartAssert\WorkerUploadedFileKey\Tests;

use PHPUnit\Framework\TestCase;
use SmartAssert\WorkerUploadedFileKey\UploadedFileKey;

class UploadedFileKeyTest extends TestCase
{
    private const KEY = 'manifest';
    private const ENCODED_KEY = 'bWFuaWZlc3Q=';

    /**
     * @dataProvider encodeDataProvider
     */
    public function testEncode(UploadedFileKey $key, string $expectedEncodedKey): void
    {
        self::assertSame($expectedEncodedKey, $key->encode());
    }

    /**
     * @return array[]
     */
    public function encodeDataProvider(): array
    {
        return [
            'empty' => [
                'key' => $this->createEmptyKey(),
                'expectedEncodedKey' => '',
            ],
            'non-empty' => [
                'key' => $this->createManifestKey(),
                'expectedEncodedKey' => self::ENCODED_KEY,
            ],
        ];
    }

    /**
     * @dataProvider fromEncodedKeyDataProvider
     */
    public function testFromEncodedKey(string $encodedKey, UploadedFileKey $expectedKey): void
    {
        self::assertEquals($expectedKey, UploadedFileKey::fromEncodedKey($encodedKey));
    }

    /**
     * @return array[]
     */
    public function fromEncodedKeyDataProvider(): array
    {
        return [
            'empty' => [
                'encodedKey' => '',
                'expectedKey' => $this->createEmptyKey(),
            ],
            'non-empty' => [
                'encodedKey' => self::ENCODED_KEY,
                'expectedKey' => $this->createManifestKey(),
            ],
        ];
    }

    private function createEmptyKey(): UploadedFileKey
    {
        return new UploadedFileKey('');
    }

    private function createManifestKey(): UploadedFileKey
    {
        return new UploadedFileKey(self::KEY);
    }
}
