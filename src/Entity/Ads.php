<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ads
 *
 * @ORM\Table(name="ads", indexes={@ORM\Index(name="component_type_id", columns={"component_type_id"}), @ORM\Index(name="ad_status_id", columns={"ad_status_id"}), @ORM\Index(name="component_id", columns={"component_id"})})
 * @ORM\Entity
 */
class Ads
{
    /**
     * @var bool
     *
     * @ORM\Column(name="id", type="boolean", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="name", type="integer", nullable=false)
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
     * @var \AdStatuses
     *
     * @ORM\ManyToOne(targetEntity="AdStatuses")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ad_status_id", referencedColumnName="id")
     * })
     */
    private $adStatus;

    /**
     * @var \ComponentTypes
     *
     * @ORM\ManyToOne(targetEntity="ComponentTypes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="component_type_id", referencedColumnName="id")
     * })
     */
    private $componentType;

    /**
     * @var \Components
     *
     * @ORM\ManyToOne(targetEntity="Components")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="component_id", referencedColumnName="id")
     * })
     */
    private $component;

    public function getId(): ?bool
    {
        return $this->id;
    }

    public function getName(): ?int
    {
        return $this->name;
    }

    public function setName(int $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(int $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getX(): ?int
    {
        return $this->x;
    }

    public function setX(int $x): self
    {
        $this->x = $x;

        return $this;
    }

    public function getY(): ?int
    {
        return $this->y;
    }

    public function setY(int $y): self
    {
        $this->y = $y;

        return $this;
    }

    public function getZ(): ?int
    {
        return $this->z;
    }

    public function setZ(int $z): self
    {
        $this->z = $z;

        return $this;
    }

    public function getAdStatus(): ?AdStatuses
    {
        return $this->adStatus;
    }

    public function setAdStatus(?AdStatuses $adStatus): self
    {
        $this->adStatus = $adStatus;

        return $this;
    }

    public function getComponentType(): ?ComponentTypes
    {
        return $this->componentType;
    }

    public function setComponentType(?ComponentTypes $componentType): self
    {
        $this->componentType = $componentType;

        return $this;
    }

    public function getComponent(): ?Components
    {
        return $this->component;
    }

    public function setComponent(?Components $component): self
    {
        $this->component = $component;

        return $this;
    }


}
