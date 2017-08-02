<?php

/**
 * This file is part of the TimeTM package.
 *
 * (c) TimeTM <https://github.com/timetm>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Time;

/**
 * User fixture
 *
 * @author André Friedli <a@frian.org>
 */
class LoadTimeData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

    	$data = array(
    		0 => array(
    			'name' => 'present indicative',
    		),
    		1 => array(
    			'name' => 'present perfect',
    		),
            2 => array(
    			'name' => 'imperfect indicative'
    		),
            3 => array(
    			'name' => 'simple futur'
    		)
    	);

    	/**
    	 * Add users
    	 */
    	foreach ( $data as $index => $item ) {

	    	// create user
	        $object = new Time();
	        $object->setName($item['name']);

	        // add reference for further fixtures
	        $this->addReference('time'.$index, $object);

	    	$manager->persist($object);
	    	$manager->flush();
    	}

    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
    	return 1; // the order in which fixtures will be loaded
    }
}
