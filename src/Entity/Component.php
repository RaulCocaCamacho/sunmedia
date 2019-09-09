<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * Component
 *
 * @ApiResource()
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
     * @var \ComponentType
     *
     * @ORM\ManyToOne(targetEntity="ComponentType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="component_type_id", referencedColumnName="id")
     * })
     */
    private $componentType;

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
     *
     * @ORM\Column(name="text", type="string", length=140, nullable=true)
     */
    private $text;

    public $imageFormatAccepted = ['JPG', 'PNG'];
    public $videoFormatAccepted = ['MP4', 'WEBN'];

    public function getId(): ?int {
        return $this->id;
    }

    public function getComponentType(): ?ComponentType {
        return $this->componentType;
    }

    public function setComponentType(?ComponentType $componentType): self {
        $this->componentType = $componentType;

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
