<?php

namespace Pionyr\PionyrCz\Entity;

use PascalDeVink\ShortUuid\ShortUuid;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Trait to add UUID & ShortUUID capabilities to value objects.
 */
trait IdentifiableTrait
{
    /** @var UuidInterface */
    protected $uuid;

    public function getUuid()
    {
        return $this->uuid;
    }

    public function getShortUuid()
    {
        $shortUuid = new ShortUuid();

        return $shortUuid->encode($this->getUuid());
    }

    protected function setUuidFromString($uuid)
    {
        $this->uuid = Uuid::fromString($uuid);
    }
}
