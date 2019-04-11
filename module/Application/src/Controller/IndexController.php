<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $hits = [
            '2019-06-01' => 6,
            '2019-06-02' => 8,
            '2019-06-03' => 7,
            '2019-06-04' => 10,
        ];

        return new ViewModel([
            'hits' => $hits,
        ]);
    }
}
