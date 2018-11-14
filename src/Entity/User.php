<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="account", schema="main", uniqueConstraints={
 *      @ORM\UniqueConstraint(name="user_email_idx", columns={"email"})
 * })
 * @UniqueEntity("email")
 */
class User
{
    /**
     * @ORM\Column(type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @Assert\Uuid
     * @var string
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Email()
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @var string
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Length(max=100)
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @var string
     */
    private $firstName;
    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Length(max=100)
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @var string
     */
    private $lastName;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     * @var \Datetime $createdAt
     */
    private $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime")
     * @Gedmo\Timestampable(on="update")
     * @var \Datetime $updatedAt
     */
    private $updatedAt;
    
    /**
     * @ORM\Column(type="json", options={"jsonb": true}, options={"default" : "{}"})
     * @var array $data
     */
    private $data = [];

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): User
    {
        $this->id = $id;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): User
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): User
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getCreatedAt(): ?\Datetime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\Datetime
    {
        return $this->updatedAt;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data): User
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPreferences()
    {
        return $this->preferences;
    }

    /**
     * @param mixed $preferences
     */
    public function setPreferences($preferences)
    {
        $this->preferences = $preferences;
    }

    /**
     * @param Preference $preference
     * @return $this
     */
    public function addPreference(\App\Entity\Preference $preference)
    {
        $this->preferences[] = $preference;

        return $this;
    }

    /**
     * Remove preference
     *
     * @param \App\Entity\Preference $preference
     */
    public function removePreference(\App\Entity\Preference $preference)
    {
        $this->preferences->removeElement($preference);
    }

    /**
     * @return bool
     */
    public function preferencesMatch($themes)
    {
        $matchValue = 0;
        foreach ($this->preferences as $preference) {
            foreach ($this->theme as $theme) {

                if ($preference->match($theme)) {
                    $matchValue += $preference->getValue() * $theme->getValue();
                }
            }
        }
        return  $matchValue >= self::MATCH_VALUE_THRESHOLD;
    }
}
