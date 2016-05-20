<?php

namespace SON\Validator;

use SONBase\Test\TestCase;

class PrimoTest extends TestCase
{
    public function test_verifica_se_classe_de_primo_existe()
    {
        if(!class_exists('\\SON\\Validator\\Primo'))
            $this->markTestSkipped('Classe não existe');
    }
    
    public function test_verifica_se_classe_herda_de_AbstractValidator()
    {
        $this->assertInstanceOf('Zend\Validator\AbstractValidator', new Primo);
    }
    
    public function test_verifica_se_nao_e_numero()
    {
        $class = new Primo;
        $result = $class->isValid('oi');
        
        $this->assertFalse($result);
    }
    
    public function test_verifica_se_e_menor_que_1()
    {
        $class = new Primo;
        $result = $class->isValid(0);
        
        $this->assertFalse($result);
    }
    
    public function number_provider_prime()
    {
        return [
            [2],[3],[13]
        ];
    }
    
    public function number_provider_nao_primo()
    {
        return [
          [6],[10],[12]  
        ];
    }
    
    /**
     * @dataProvider number_provider_prime
     */
    public function test_verifica_se_resto_da_divisao_entre_2_e_o_numero_e_0($numero)
    {
        $class = new Primo;
        $result = $class->isValid($numero);
        
        $this->assertTrue($result);
    }
    
    /**
     * @dataProvider number_provider_nao_primo
     */
    public function test_verifica_se_resto_da_divisao_entre_2_e_o_numero_e_diferente_de_0($numero)
    {
        $class = new Primo;
        $result = $class->isValid($numero);
        $this->assertFalse($result);
    }
    
    public function test_verifica_mensagem_de_erro_quando_numero_nao_e_primo()
    {
        $class = new Primo;
        $result = $class->isValid(10);
        
        $this->assertArrayHasKey('notPrime',$class->getMessages());
        $this->assertEquals('Esse não é um número primo', $class->getMessages()['notPrime']);
    }
}
