<?php

namespace Acme\ConferenceBundle\Features\Context;

use Acme\ConferenceBundle\Entity\Conference;
use Symfony\Component\HttpKernel\KernelInterface;
use Behat\Symfony2Extension\Context\KernelAwareInterface;
use Behat\MinkExtension\Context\MinkContext;

use Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Feature context.
 */
class FeatureContext extends MinkContext
                  implements KernelAwareInterface
{
    private $kernel;
    private $parameters;

    /**
     * Initializes context with parameters from behat.yml.
     *
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * Sets HttpKernel instance.
     * This method will be automatically called by Symfony2Extension ContextInitializer.
     *
     * @param KernelInterface $kernel
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @Given /^the database starts out clear$/
     * @Given /^the database is clear$/
     */
    public function theDatabaseIsClear()
    {
        $em = $this->getManager();
        $metadata = $em->getMetadataFactory()->getAllMetadata();

        $tool = new \Doctrine\ORM\Tools\SchemaTool($em);
        $tool->dropSchema($metadata);
        $tool->createSchema($metadata);
    }

    /**
     * @Given /^there is one conference called "([^"]*)" in "([^"]*)"$/
     */
    public function thereIsOneConferenceCalledIn($arg1, $arg2)
    {
        $em = $this->getManager();

        $conference = new Conference();
        $conference->setName($arg1);
        $conference->setStartDate(new \DateTime('now'));
        $conference->setEndDate(new \DateTime('now + 1 day'));
        $conference->setLocation($arg2);

        $em->persist($conference);
        $em->flush();
    }

    private function getDoctrine()
    {
        return $this->kernel->getContainer()->get('doctrine');
    }

    private function getManager()
    {
        return $this->getDoctrine()->getManager();
    }
}
