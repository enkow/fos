<?php
/**
 * Example entity.
 *
 * @copyright (c) 2016 Grzegorz Stefański
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class Example.
 *
 * @package Entity
 * @author Grzegorz Stefański <grzesiekk94@gmail.com>
 *
 * @ORM\Table(name="examples")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Example")
 * @UniqueEntity(fields="name", groups={"example-default"})
 */
class Example
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
     * Name.
     *
     * @ORM\Column(
     *     name="name",
     *     type="string",
     *     length=128,
     *     nullable=false
     * )
     * @Assert\NotBlank(groups={"example-default"})
     * @Assert\Length(min=3, max=128, groups={"example-default"})
     *
     * @var string $name
     */
    private $name;

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
     * Set name.
     *
     * @param string $name Name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name.
     *
     * @return string Name
     */
    public function getName()
    {
        return $this->name;
    }
}
