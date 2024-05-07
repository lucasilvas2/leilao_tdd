# Php - TDD - PHPUnit

## Abordagens de estrutura de teste

- [ArrangeActAssert](http://wiki.c2.com/?ArrangeActAssert)
- [Given-When-Then](https://martinfowler.com/bliki/GivenWhenThen.html)

## Técnicas indetificação de testes

- Análise de fronteiras: testar valores nas bordas dos valores limites
- Classes de equivalências: esqcolher valores de cada partição que compartilhem a mesma carecteristicas

## PHP Unit

### [Iniciando](https://docs.phpunit.de/en/11.1/writing-tests-for-phpunit.html#)

- Crie uma pasta na raiz do projeto: “tests/Service”
- Class extend TestCase
- Class nome finalizada com “Test”
- Funções iniciadas com “test”
- Comando:
  ``vendor/bin/phpunit --colors test``

### [Data providers](https://docs.phpunit.de/en/11.1/writing-tests-for-phpunit.html#data-providers)

- Evita repetição de código
- Definir funções que gerem estruturas de dados utilizadoa no teste
- Responsável por gerenciar os teste utilizando diferentes data providers disponiveis
- Utiliza [annotations](https://docs.phpunit.de/en/11.1/annotations.html):
  ````php
  /**
  * @dataProvider dadosEmOrdemDecrescente
  * @dataProvider dadosEmOrdemCrescente
  * @dataProvider dadosEmOrdemAleatoria
  */
  ````
### [Fixtures](https://docs.phpunit.de/en/11.1/fixtures.html)

- Possibilita executar ações e reverter ações durante cada etapa ao realizar um test
- Utilizando funções antes de iniciar e depois de finalizar todos os teste, antes e depois de cada teste:
  - ``public static function setUpBeforeClass(): void`` - Método executado uma vez só, antes de todos os testes da classe
  -  ``protected function setUp(): void`` - Método executado antes de cada teste da classe
  - ``protected function tearDown(): void`` - Método executado após cada teste da classe
  - ``public static function tearDownAfterClass(): void`` - Método executado uma vez só, após todos os testes da classe

### [XML Configuration]()

- É possível definir a estrutura de configuração básica, estabelecendo parâmetros para a execução dos testes, bem como opções adicionais para a geração de logs.
  ````xml
  <?xml version="1.0"?>
  <phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
           xsi:noNamespaceSchemaLocation="https://schema.phpunit.de/10.0/phpunit.xsd" colors="true"
           cacheDirectory=".phpunit.cache">
      <coverage/>
      <testsuites>
          <testsuite name="unit">
              <directory>tests</directory>
          </testsuite>
      </testsuites>
      <logging>
          <testdoxText outputFile="testes-executados.txt"/>
          <testdoxHtml outputFile="testdox.html"/>
      </logging>
  </phpunit>
  ````