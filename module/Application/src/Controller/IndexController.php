<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction(): ViewModel
    {
        $hits = [
            '2021-04-01' => 6,
            '2021-04-02' => 8,
            '2021-04-03' => 7,
            '2021-04-04' => 10,
        ];

        return new ViewModel([
            'hits' => $hits,
        ]);
    }
}
