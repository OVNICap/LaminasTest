<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace ApplicationTest\Controller;

use Application\Controller\IndexController;
use Laminas\Stdlib\ArrayUtils;
use Laminas\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class IndexControllerTest extends AbstractHttpControllerTestCase
{
    public function setUp(): void
    {
        // The module configuration should still be applicable for tests.
        // You can override configuration here with test case specific values,
        // such as sample view templates, path stacks, module_listener_options,
        // etc.
        $configOverrides = [];

        $this->setApplicationConfig(ArrayUtils::merge(
            include __DIR__ . '/../../../../config/application.config.php',
            $configOverrides
        ));

        parent::setUp();
    }

    public function testIndexActionCanBeAccessed(): void
    {
        $this->dispatch('/', 'GET');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('application');
        $this->assertControllerName(IndexController::class); // as specified in router's controller name alias
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('home');

        $hits = [
            '2021-04-01' => count(file(__DIR__ . '/../../../../data/cache/2021-04-01.log')),
            '2021-04-02' => count(file(__DIR__ . '/../../../../data/cache/2021-04-02.log')),
            '2021-04-03' => count(file(__DIR__ . '/../../../../data/cache/2021-04-03.log')),
            '2021-04-04' => count(file(__DIR__ . '/../../../../data/cache/2021-04-04.log')),
        ];

        $this->assertStringContainsString(
            'data-hits="' . htmlspecialchars(json_encode($hits)) . '"',
            $this->getResponse()->getContent()
        );
    }

    /**
     * @group performances
     */
    public function testIndexActionPerformance(): void
    {
        // Evaluate machine performances indexed on non-optimized code
        $baseTime = microtime(true);

        count(file(__DIR__ . '/../../../../data/cache/2021-04-01.log'));
        count(file(__DIR__ . '/../../../../data/cache/2021-04-02.log'));
        count(file(__DIR__ . '/../../../../data/cache/2021-04-03.log'));
        count(file(__DIR__ . '/../../../../data/cache/2021-04-04.log'));

        $baseTime = microtime(true) - $baseTime;

        // Expect the new code to be at least 60 times faster
        $speed = 60;

        $consumed = 0;
        $controller = new IndexController();

        for ($i = 0; $consumed < 1; $i++) {
            $m = microtime(true);
            $controller->indexAction();
            $consumed += microtime(true) - $m;
        }

        $this->assertGreaterThan(
            $speed / $baseTime,
            $i,
            'IndexController::indexAction should be at least ' . round(2000 / $i) . ' times faster'
        );
    }

    public function testIndexActionCanBeParametrized(): void
    {
        $this->dispatch('/?start=2021-04-02&end=2021-04-03', 'GET');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('application');
        $this->assertControllerName(IndexController::class); // as specified in router's controller name alias
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('home');

        $hits = [
            '2021-04-02' => count(file(__DIR__ . '/../../../../data/cache/2021-04-02.log')),
            '2021-04-03' => count(file(__DIR__ . '/../../../../data/cache/2021-04-03.log')),
        ];

        $this->assertStringContainsString(
            'data-hits="' . htmlspecialchars(json_encode($hits)) . '"',
            $this->getResponse()->getContent()
        );
    }

    public function testIndexActionViewModelTemplateRenderedWithinLayout(): void
    {
        $this->dispatch('/', 'GET');
        $this->assertQuery('.container .jumbotron');
    }

    public function testInvalidRouteDoesNotCrash(): void
    {
        $this->dispatch('/invalid/route', 'GET');
        $this->assertResponseStatusCode(404);
    }
}
