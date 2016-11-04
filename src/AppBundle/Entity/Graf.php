<?php
/**
 * Graf entity.
 *
 * @copyright (c) 2016 Grzegorz Stefański
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class Graf.
 *
 * @package Entity
 * @author Grzegorz Stefański <grzesiekk94@gmail.com>
 *
 * @ORM\Table(name="grafs")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Graf")
 * @UniqueEntity(fields="name", groups={"graf-default"})
 */
class Graf
{
    /**
     * Id.
     *
     * @ORM\Id
     * @ORM\Column(
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "unsigned" = true
     *     }
     * )
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @var integer $id
     */
    private $id;

    /**
     * h.
     *
     * @ORM\Column(
     *     name="g1",
     *     type="integer",
     *     nullable=true
     * )
     * @Assert\NotBlank(groups={"graf-default"})
     *
     * @var string $name
     */
    private $g1;

    /**
     * h.
     *
     * @ORM\Column(
     *     name="g2",
     *     type="integer",
     *     nullable=true
     * )
     * @Assert\NotBlank(groups={"graf-default"})
     *
     * @var string $name
     */
    private $g2;

    /**
     * h.
     *
     * @ORM\Column(
     *     name="g3",
     *     type="integer",
     *     nullable=true
     * )
     * @Assert\NotBlank(groups={"graf-default"})
     *
     * @var string $name
     */
    private $g3;

    /**
     * h.
     *
     * @ORM\Column(
     *     name="g4",
     *     type="integer",
     *     nullable=true
     * )
     * @Assert\NotBlank(groups={"graf-default"})
     *
     * @var string $name
     */
    private $g4;



    /**
     * Set Id.
     *
     * @param string $id Id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get Id.
     *
     * @return integer Result
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set g1.
     *
     * @param string $g1 G1
     */
    public function setG1($g1)
    {
        $this->g1 = $g1;
    }

    /**
     * Get g1.
     *
     * @return string G1
     */
    public function getG1()
    {
        return $this->g1;
    }

    /**
     * Set g2.
     *
     * @param string $g2 G2
     */
    public function setG2($g2)
    {
        $this->g2 = $g2;
    }

    /**
     * Get g2.
     *
     * @return string G2
     */
    public function getG2()
    {
        return $this->g2;
    }

    /**
     * Set g3.
     *
     * @param string $g3 G3
     */
    public function setG3($g3)
    {
        $this->g3 = $g3;
    }

    /**
     * Get g3.
     *
     * @return string G3
     */
    public function getG3()
    {
        return $this->g3;
    }

    /**
     * Set g4.
     *
     * @param string $g4 G4
     */
    public function setG4($g4)
    {
        $this->g4 = $g4;
    }

    /**
     * Get g4.
     *
     * @return string G4
     */
    public function getG4()
    {
        return $this->g4;
    }
}
