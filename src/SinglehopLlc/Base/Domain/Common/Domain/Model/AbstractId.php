<?php

namespace SinglehopLlc\Base\Domain\Common\Domain\Model;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class AbstractId
 * @package SinglehopLlc\Base\Domain\Common\Domain\Model
 */
class AbstractId
{
    private $id;

    /**
     * AbstractId constructor.
     * @param UuidInterface $id
     */
    public function __construct(UuidInterface $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return $this->id->toString();
    }

    /**
     * @param string $id
     * @return static
     */
    public static function fromString(string $id)
    {
        return new static(Uuid::fromString($id));
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toString();
    }

    /**
     * @return static
     */
    public function generate()
    {
        return new static(Uuid::uuid4());
    }

    /**
     * @param AbstractId $comparedId
     * @return bool
     */
    public function sameValueAs(AbstractId $comparedId) : bool
    {
        return $this->toString() === $comparedId->toString();
    }
}
