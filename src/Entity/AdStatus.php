<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * AdStatus
 *
 * @ApiResource()
 * @ORM\Table(name="ad_statuses")
 * @ORM\Entity
 */
class AdStatus implements \JsonSerializable {
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    const PUBLISHED = 1;
    const stopped = 2;
    const publishing = 3;

    public function getId(): ?int {
        return $this->id;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(string $name): self {
        $this->name = $name;

        return $this;
    }

    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
