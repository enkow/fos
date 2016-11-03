<?php
/**
 * Example repository.
 *
 * @copyright (c) 2016 Grzegorz Stefański
 */

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class Example.
 *
 * @package Model
 * @author Grzegorz Stefański <grzesiekk94@gmail.com>
 */
class Example extends EntityRepository
{
    /**
     * Save example object.
     *
     * @param Example $example Example object
     */
    public function save(\AppBundle\Entity\Example $example)
    {
        $this->_em->persist($example);
        $this->_em->flush();
    }

    /**
     * Remove example object.
     *
     * @param $example Example object
     *
     */
    public function delete(\AppBundle\Entity\Example $example)
    {
        $this->_em->remove($example);
        $this->_em->flush();
    }
}
