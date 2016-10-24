<?php

use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Tester\Exception\PendingException;
use app\BaseContext;
class FeatureContext extends BaseContext
{
    public function __construct()
    {
        $this->nomeModulo = 'conpepe';
    }


}
