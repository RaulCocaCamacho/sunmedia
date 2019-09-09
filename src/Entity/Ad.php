<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Ads
 *
 * @ApiResource()
 * @ORM\Table(name="ads", indexes={@ORM\Index(name="component_type_id", columns={"component_type_id"}), @ORM\Index(name="ad_status_id", columns={"ad_status_id"}), @ORM\Index(name="component_id", columns={"component_id"})})
 * @ORM\Entity
 */
class Ad implements \JsonSerializable {
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
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="width", type="integer", nullable=false)
     */
    private $width;

    /**
     * @var int
     *
     * @ORM\Column(name="height", type="integer", nullable=false)
     */
    private $height;

    /**
     * @var int
     *
     * @ORM\Column(name="x", type="integer", nullable=false)
     */
    private $x;

    /**
     * @var int
     *
     * @ORM\Column(name="y", type="integer", nullable=false)
     */
    private $y;

    /**
     * @var int
     *
     * @ORM\Column(name="z", type="integer", nullable=false)
     */
    private $z;

    /**
     * @var \AdStatus
     *
     * @ORM\ManyToOne(targetEntity="AdStatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ad_status_id", referencedColumnName="id")
     * })
     */
    private $adStatus;

    /**
     * @var \Component
     *
     * @ORM\ManyToOne(targetEntity="Component")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="component_id", referencedColumnName="id")
     * })
     */
    private $component;

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

    public function getWidth(): ?int {
        return $this->width;
    }

    public function setWidth(int $width): self {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): ?int {
        return $this->height;
    }

    public function setHeight(int $height): self {
        $this->height = $height;

        return $this;
    }

    public function getX(): ?int {
        return $this->x;
    }

    public function setX(int $x): self {
        $this->x = $x;

        return $this;
    }

    public function getY(): ?int {
        return $this->y;
    }

    public function setY(int $y): self {
        $this->y = $y;

        return $this;
    }

    public function getZ(): ?int {
        return $this->z;
    }

    public function setZ(int $z): self {
        $this->z = $z;

        return $this;
    }

    public function getAdStatus(): ?AdStatus {
        return $this->adStatus;
    }

    public function setAdStatus(?AdStatus $adStatus): self {
        $this->adStatus = $adStatus;

        return $this;
    }

    public function getComponent(): ?Component {
        return $this->component;
    }

    public function setComponent(?Component $component): self {
        $this->component = $component;

        return $this;
    }

    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'width' => $this->width,
            'height' => $this->height,
            'x' => $this->x,
            'y' => $this->y,
            'z' => $this->z,
            'ad_status' => $this->adStatus,
            'component' => $this->component,
        ];
    }
}
