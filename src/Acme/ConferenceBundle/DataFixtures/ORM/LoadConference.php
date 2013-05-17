<?php

namespace Acme\ConferenceBundle\DataFixtures\ORM;

use Acme\ConferenceBundle\Entity\Conference;
use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadConference implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $conference = new Conference();
        $conference->setName('php[tek] 2013');
        $conference->setStartDate(new \DateTime('2013/05/14'));
        $conference->setEndDate(new \DateTime('2013/05/17'));
        $conference->setLocation('Sheraton Chicago O\'Hare Airport Hotel');
        $this->container->get('acme_conference.geocoder')->encode($conference);
        $manager->persist($conference);

        $conference = new Conference();
        $conference->setName('Symfony Live Portland 2013');
        $conference->setStartDate(new \DateTime('2013/05/20'));
        $conference->setEndDate(new \DateTime('2013/05/24'));
        $conference->setLocation('Oregon Convention Center');
        $this->container->get('acme_conference.geocoder')->encode($conference);
        $manager->persist($conference);

        $conference = new Conference();
        $conference->setName('IPC Spring 2013');
        $conference->setStartDate(new \DateTime('2013/06/02'));
        $conference->setEndDate(new \DateTime('2013/06/25'));
        $conference->setLocation('Maritim Proarte Berlin');
        $this->container->get('acme_conference.geocoder')->encode($conference);
        $manager->persist($conference);

        $conference = new Conference();
        $conference->setName('Symfony User Group Cologne');
        $conference->setStartDate(new \DateTime('2013/06/13'));
        $conference->setEndDate(new \DateTime('2013/06/13'));
        $conference->setLocation('SensioLabs Deutschland GmbH, Neusser Straße 27-29, 50670 Köln');
        $this->container->get('acme_conference.geocoder')->encode($conference);
        $manager->persist($conference);

        $manager->flush();
    }

    /**
     * Sets the Container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     *
     * @api
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
