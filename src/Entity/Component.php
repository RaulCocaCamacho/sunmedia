<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Components
 *
 * @ORM\Table(name="components", indexes={@ORM\Index(name="component_type_id", columns={"component_type_id"})})
 * @ORM\Entity
 */
class Component {
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="component_type_id", type="integer", nullable=false)
     */
    private $componentTypeId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="link", type="string", length=250, nullable=true)
     */
    private $link;

    /**
     * @var string|null
     *
     * @ORM\Column(name="format", type="string", length=10, nullable=true)
     */
    private $format;

    /**
     * @var int|null
     *
     * @ORM\Column(name="weight", type="integer", nullable=true)
     */
    private $weight;

    /**
     * @var string|null
     *
     * @ORM\Column(name="text", type="string", length=250, nullable=true)
     */
    private $text;

    public function getId(): ?int {
        return $this->id;
    }

    public function getComponentTypeId(): ?int {
        return $this->componentTypeId;
    }

    public function setComponentTypeId(int $componentTypeId): self {
        $this->componentTypeId = $componentTypeId;

        return $this;
    }

    public function getLink(): ?string {
        return $this->link;
    }

    public function setLink(?string $link): self {
        $this->link = $link;

        return $this;
    }

    public function getFormat(): ?string {
        return $this->format;
    }

    public function setFormat(?string $format): self {
        $this->format = $format;

        return $this;
    }

    public function getWeight(): ?int {
        return $this->weight;
    }

    public function setWeight(?int $weight): self {
        $this->weight = $weight;

        return $this;
    }

    public function getText(): ?string {
        return $this->text;
    }

    public function setText(?string $text): self {
        $this->text = $text;

        return $this;
    }

}
