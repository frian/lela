<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Verb
 *
 * @ORM\Table(name="verb")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VerbRepository")
 */
class Verb
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="VerbConjugation", mappedBy="verb", cascade={"persist", "remove"})
     */
    protected $conjugations;


    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\VerbTranslation", cascade={"persist"})
     */
    protected $translations;


    public function __toString() {
        return $this->name;
    }


    public function __construct()
    {
        $this->conjugations = new ArrayCollection();
    }

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
     * @return Verb
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
     * Set conjugations
     *
     * @param string $conjugations
     *
     * @return Verb
     */
    public function setConjugations($conjugations)
    {
        $this->conjugations = $conjugations;

        return $this;
    }

    /**
     * Get conjugations
     *
     * @return string
     */
    public function getConjugations()
    {
        return $this->conjugations;
    }

    /**
     * Add conjugation
     *
     * @param \AppBundle\Entity\VerbConjugation $conjugation
     *
     * @return Verb
     */
    public function addConjugation(\AppBundle\Entity\VerbConjugation $conjugation)
    {
        $this->conjugations[] = $conjugation;

        return $this;
    }

    /**
     * Remove conjugation
     *
     * @param \AppBundle\Entity\VerbConjugation $conjugation
     */
    public function removeConjugation(\AppBundle\Entity\VerbConjugation $conjugation)
    {
        $this->conjugations->removeElement($conjugation);
    }

    /**
     * Add translation
     *
     * @param \AppBundle\Entity\VerbTranslation $translation
     *
     * @return Verb
     */
    public function addTranslation(\AppBundle\Entity\VerbTranslation $translation)
    {
        $this->translations[] = $translation;

        return $this;
    }

    /**
     * Remove translation
     *
     * @param \AppBundle\Entity\VerbTranslation $translation
     */
    public function removeTranslation(\AppBundle\Entity\VerbTranslation $translation)
    {
        $this->translations->removeElement($translation);
    }

    /**
     * Get translations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTranslations()
    {
        return $this->translations;
    }
}
