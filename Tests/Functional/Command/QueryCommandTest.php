<?php

namespace Massive\Bundle\SearchBundle\Tests\Functional;

use Massive\Bundle\SearchBundle\Tests\Resources\TestBundle\Entity\Product;
use Massive\Bundle\SearchBundle\Tests\Resources\TestBundle\EventSubscriber\TestSubscriber;
use Symfony\Component\Console\Tester\CommandTester;
use Massive\Bundle\SearchBundle\Command\QueryCommand;
use Symfony\Bundle\FrameworkBundle\Console\Application;

class QueryCommandTest extends BaseTestCase
{
    public function setUp()
    {
        $command = new QueryCommand();
        $application = new Application($this->getContainer()->get('kernel'));
        $command->setApplication($application);
        $this->tester = new CommandTester($command);
        $this->generateIndex(10);
    }

    public function testCommand()
    {
        $this->tester->execute(array(
            'query' => 'Hello',
            '--index' => 'product',
        ));

        $display = $this->tester->getDisplay();
        $display = explode("\n", $display);
        $this->assertCount(15, $display);
    }
}

