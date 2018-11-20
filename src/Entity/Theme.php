<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="theme",
 *      uniqueConstraints={@ORM\UniqueConstraint(name="themes_name_place_unique", columns={"name"})}
 * )
 */
class Theme
{
    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="integer")
     */
    protected $value;

    /**
     * @ORM\OneToMany(targetEntity="Place", mappedBy="themes")
     * @var Place
     */
    protected $places;

    /**
     * @ORM\Column(type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @Assert\Uuid
     * @var string
     */
    private $id;

    public function __construct()
    {
        $this->places = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;

    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;

    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
        return $this;

    }


    public function addPlace(Place $place): self
    {
        if (!$this->places->contains($place)) {
            $this->places[] = $place;
        }

        return $this;
    }

    public function removePlace(Place $place): self
    {
        $this->places->removeElement($place);
        $this->setPlaces(null);

        return $this;
    }

    /**
     * @return Place
     */
    public function getPlaces(): Place
    {
        return $this->places;
    }

    /**
     * @param Place $places
     */
    public function setPlaces(Place $places)
    {
        $this->places = $places;
    }
}

