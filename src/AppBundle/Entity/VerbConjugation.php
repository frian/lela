<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Verb
 *
 * @ORM\Table(name="verbconjugation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VerbConjugationRepository")
 */
class VerbConjugation
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
     * @ORM\ManyToOne(
     *      targetEntity="Verb",
     *      inversedBy="conjugations"
     * )
     * @ORM\JoinColumn(
     *      name="verb_id",
     *      referencedColumnName="id",
     *      onDelete="CASCADE",
     *      nullable=false
     * )
     */
    protected $verb;

    /**
    * @ORM\ManyToOne(
    *      targetEntity="Time",
    *      inversedBy="conjugations"
    * )
    * @ORM\JoinColumn(
    *      name="time_id",
    *      referencedColumnName="id",
    *      onDelete="CASCADE",
    *      nullable=false
    * )
     */
    private $time;

    /**
     * @var string
     *
     * @ORM\Column(name="firstSing", type="string", length=255)
     */
    private $firstSing;

    /**
     * @var string
     *
     * @ORM\Column(name="secondSing", type="string", length=255)
     */
    private $secondSing;

    /**
     * @var string
     *
     * @ORM\Column(name="thirdSing", type="string", length=255)
     */
    private $thirdSing;

    /**
     * @var string
     *
     * @ORM\Column(name="firstPlur", type="string", length=255)
     */
    private $firstPlur;

    /**
     * @var string
     *
     * @ORM\Column(name="secondPlur", type="string", length=255)
     */
    private $secondPlur;

    /**
     * @var string
     *
     * @ORM\Column(name="thirdPLur", type="string", length=255)
     */
    private $thirdPLur;


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
     * Set time
     *
     * @param integer $time
     *
     * @return Verb
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return int
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set firstSing
     *
     * @param string $firstSing
     *
     * @return Verb
     */
    public function setFirstSing($firstSing)
    {
        $this->firstSing = $firstSing;

        return $this;
    }

    /**
     * Get firstSing
     *
     * @return string
     */
    public function getFirstSing()
    {
        return $this->firstSing;
    }

    /**
     * Set secondSing
     *
     * @param string $secondSing
     *
     * @return Verb
     */
    public function setSecondSing($secondSing)
    {
        $this->secondSing = $secondSing;

        return $this;
    }

    /**
     * Get secondSing
     *
     * @return string
     */
    public function getSecondSing()
    {
        return $this->secondSing;
    }

    /**
     * Set thirdSing
     *
     * @param string $thirdSing
     *
     * @return Verb
     */
    public function setThirdSing($thirdSing)
    {
        $this->thirdSing = $thirdSing;

        return $this;
    }

    /**
     * Get thirdSing
     *
     * @return string
     */
    public function getThirdSing()
    {
        return $this->thirdSing;
    }

    /**
     * Set firstPlur
     *
     * @param string $firstPlur
     *
     * @return Verb
     */
    public function setFirstPlur($firstPlur)
    {
        $this->firstPlur = $firstPlur;

        return $this;
    }

    /**
     * Get firstPlur
     *
     * @return string
     */
    public function getFirstPlur()
    {
        return $this->firstPlur;
    }

    /**
     * Set secondPlur
     *
     * @param string $secondPlur
     *
     * @return Verb
     */
    public function setSecondPlur($secondPlur)
    {
        $this->secondPlur = $secondPlur;

        return $this;
    }

    /**
     * Get secondPlur
     *
     * @return string
     */
    public function getSecondPlur()
    {
        return $this->secondPlur;
    }

    /**
     * Set thirdPLur
     *
     * @param string $thirdPLur
     *
     * @return Verb
     */
    public function setThirdPLur($thirdPLur)
    {
        $this->thirdPLur = $thirdPLur;

        return $this;
    }

    /**
     * Get thirdPLur
     *
     * @return string
     */
    public function getThirdPLur()
    {
        return $this->thirdPLur;
    }

    /**
     * Set verb
     *
     * @param \AppBundle\Entity\Verb $verb
     *
     * @return VerbConjugation
     */
    public function setVerb(\AppBundle\Entity\Verb $verb = null)
    {
        $this->verb = $verb;

        return $this;
    }

    /**
     * Get verb
     *
     * @return \AppBundle\Entity\Verb
     */
    public function getVerb()
    {
        return $this->verb;
    }

    /**
     * Set country
     *
     * @param \AppBundle\Entity\Verb $country
     *
     * @return VerbConjugation
     */
    public function setCountry(\AppBundle\Entity\Verb $country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \AppBundle\Entity\Verb
     */
    public function getCountry()
    {
        return $this->country;
    }
}
