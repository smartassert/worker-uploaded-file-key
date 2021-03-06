<?php

declare(strict_types=1);

namespace SmartAssert\WorkerUploadedFileKey;

class UploadedFileKey
{
    private string $key;

    public function __construct(string $key)
    {
        $this->key = $key;
    }

    public function __toString(): string
    {
        return $this->key;
    }

    public static function fromEncodedKey(string $encodedKey): self
    {
        return new UploadedFileKey(base64_decode($encodedKey));
    }

    public function encode(): string
    {
        return base64_encode($this->key);
    }
}
