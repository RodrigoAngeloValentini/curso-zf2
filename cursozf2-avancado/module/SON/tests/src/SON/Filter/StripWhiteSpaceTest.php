<?php

namespace SON\Filter;

use SONBase\Test\TestCase;

class StripWhiteSpaceTest extends TestCase
{
    public function test_verifica_se_classe_de_filtro_existe()
    {
        if(!class_exists('\\SON\\Filter\\StripWhiteSpace'))
            $this->markTestSkipped('Classe não existe');
    }
    
    public function test_verifica_se_classe_herda_de_AbstractFilter()
    {
        $this->assertInstanceOf('Zend\Filter\AbstractFilter', new StripWhiteSpace);
    }
    
    public function test_verifica_se_filtro_esta_removendo_espacos_em_branco_adicionais()
    {
        $frase = "Olá         Mundo";
        $filtro = new StripWhiteSpace();
        $result = $filtro->filter($frase);
        
        $this->assertEquals("Olá Mundo",$result);
    }
}
