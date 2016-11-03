<?php
/**
 * Data fixture for Example entity.
 *
 */

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Example;

/**
 * Class LoadExampleData
 */
class LoadExampleData implements FixtureInterface
{
    /**
     * Load data.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $examples = array('ex1', 'ex1', 'ex3', 'ex4');
        foreach ($examples as $example) {
            $obj = new Example();
            $obj->setName($example);
            $manager->persist($obj);
        }
        $manager->flush();
    }
}
