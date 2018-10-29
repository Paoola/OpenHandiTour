<?php

# src/AppBundle/Entity/Place.php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="place",
 *      uniqueConstraints={@ORM\UniqueConstraint(name="places_name_unique",columns={"name"})}
 * )
 */
class Place
{
    /**
     * @ORM\ManyToOne(targetEntity="Theme", inversedBy="place")
     * @ORM\JoinColumn(name="themes_id", referencedColumnName="id")
     * @var Theme[]
     *
     */
    protected $themes;

    public function __construct()
    {
        $this->themes = new ArrayCollection();
    }

    /**
     * @ORM\Column(type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @Assert\Uuid
     * @var string
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="handicap_moteur", type="string", length=255)
     */
    private $handicap_moteur;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Place
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Place
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getHandicapMoteur()
    {
        return $this->handicap_moteur;
    }

    /**
     * @param string $handicap_moteur
     */
    public function setHandicapMoteur($handicap_moteur)
    {
        $this->handicap_moteur = $handicap_moteur;
    }

    /**
     * @param string $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getThemes()
    {
        return $this->themes;
    }

    /**
     * @param mixed $themes
     */
    public function setThemes($themes)
    {
        $this->themes = $themes;
    }

    /**
     * @param Theme $theme
     * @return Place
     */
    public function addTheme(Theme $theme) : Place
    {
        $theme->setPlace($this);

        if (!$this->themes->contains($theme)) {
            $this->themes->add($theme);
        }

        return $this;
    }

    public function removeTheme(Theme $theme): Place
    {
        $this->themes->removeElement($theme);
        $theme->setPlace(null);

        return $this;
    }

}
