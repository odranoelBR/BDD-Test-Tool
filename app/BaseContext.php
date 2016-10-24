<?php
namespace app;
use Behat\Behat\Hook\Scope\AfterStepScope;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Behat\Mink\Driver\Selenium2Driver;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Testwork\Hook\Scope\BeforeSuiteScope;
use medoo;


class BaseContext extends MinkContext  implements Context
{
    protected $nomeModulo;
    protected static $db;

    public function __construct()
    {

    }

    /**
     * @BeforeSuite
     */
    public static function prepare(BeforeSuiteScope $scope)
    {
        self::$db = new medoo([
            'database_type' => 'mysql',
            'database_name' => 'autogab',
            'server' => 'localhost',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8'
        ]);

    }

    /**
     * @AfterStep
     */
    public function takeScreenShotAfterFailedStep(AfterStepScope $scope)
    {
        $path = __DIR__  . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . $this->nomeModulo . DIRECTORY_SEPARATOR .
        'features' . DIRECTORY_SEPARATOR . 'erros' . DIRECTORY_SEPARATOR;
        if (99 === $scope->getTestResult()->getResultCode()) {
            $driver = $this->getSession()->getDriver();
            if (!($driver instanceof Selenium2Driver)) {
                return;
            }

            $this->getSession()->resizeWindow(1440, 900, 'current');
            $nomeArquivo = "erro_linha_{$scope->getStep()->getLine()}.png";
            file_put_contents($path . $nomeArquivo, $this->getSession()->getDriver()->getScreenshot());
        }
    }

    /**
     * @When espero :seg segundo
     */
    public function esperoSegundo($seg)
    {
        sleep($seg);
    }

    /**
     * @Given que existe um ":tabela" com valor:
     * @Given que existem uns ":tabela" com valores:
     * @And que existe um ":tabela" com valor:
     * @And que existem uns ":tabela" com valores:
     */
    public function existeUm($tabela, TableNode  $dados)
    {
        foreach ($dados->getIterator() as $dado) {
            self::$db->insert(TradutorTabela::traduzir($tabela), $dado);
        }

    }

}
