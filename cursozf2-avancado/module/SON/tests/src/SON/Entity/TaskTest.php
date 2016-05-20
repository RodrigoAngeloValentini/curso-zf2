<?php

namespace SON\Entity;

use SONBase\Test\TestCase;

class TaskTest extends TestCase
{
    
    public function test_verifica_se_classe_task_existe()
    {
        $class = class_exists("\\SON\\Entity\\Task");
        $this->assertTrue($class);
    }
    
    public function data_provider_atributos()
    {
        return array(
            array('id',1),
            array('nome','Nome da tarefa'),
            array('descricao','Descricao da tarefa'),
            array('status',false),
            array('created_at', new \DateTime),
            array('updated_at', new \DateTime)
        );
    }
    
    /**
     * @dataProvider data_provider_atributos
     */
    public function test_verifica_se_a_classe_tem_atributos_esperados($atributo)
    {
        $this->assertClassHasAttribute($atributo,'\\SON\\Entity\\Task');
    }
    
    /**
     * @dataProvider data_provider_atributos
     */
    public function test_verifica_se_classe_possui_get_e_sets_dos_atributos($atributo,$valor)
    {
        $get = 'get'.ucfirst($atributo);
        $set = 'set'.ucfirst($atributo);
        
        $class = new Task;
        $class->$set($valor);
        
        $this->assertEquals($valor, $class->$get());
    }
    
    /**
     * @dataProvider data_provider_atributos
     */
    public function test_verifica_interface_fluente_nos_metodos_sets($atributo,$valor)
    {
        $set = 'set'.ucfirst($atributo);
        
        $class = new Task;
        $result = $class->$set($valor);
        
        $this->assertInstanceOf('\\SON\\Entity\\Task',$result);
    }
    
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage ID aceita apenas números inteiros
     */
    public function test_verifica_se_recebe_erro_se_id_nao_for_inteiro()
    {
        $class = new Task;
        $class->setId('oi');
    }
    
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage ID aceita apenas números maiores que zero
     */
    public function test_verifica_se_recebe_erro_se_id_for_negativo_ou_zero()
    {
        $class = new Task;
        $class->setId(-1);
        $class->setId(0);
    }
    
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage STATUS aceita apenas booleanos
     */
    public function test_verifica_se_recebe_erro_se_status_for_string()
    {
        $class = new Task;
        $class->setStatus('oi');
        
    }
    
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage created_at aceita apenas DateTime
     */
    public function test_verifica_se_recebe_erro_se_created_at_for_diferente_datetime()
    {
        $class = new Task;
        $class->setCreated_at('oi');
        
    }
    
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage updated_at aceita apenas DateTime
     */
    public function test_verifica_se_recebe_erro_se_updated_at_for_diferente_datetime()
    {
        $class = new Task;
        $class->setUpdated_at('oi');
        
    }
    
    public function test_verifica_se_createdAt_e_o_updatedAt_estao_sendo_inicializados()
    {
        $class = new Task;
        $this->assertInstanceOf("\\DateTime",$class->getCreated_at());
        $this->assertInstanceOf("\\DateTime",$class->getUpdated_at());
    }
    
    public function test_verifica_metodo_toArray()
    {
        $class = new Task;
        $class->setId(1)
                ->setNome("Tarefa")
                ->setDescricao("Descricao da tarefa")
                ->setStatus(true);
        
        $result = $class->toArray();
        
        $array = array(
          'id' => 1,
            'nome' => 'Tarefa',
           'descricao' => 'Descricao da tarefa',
            'status'=>true,
            'created_at' => new \DateTime("now"),
            'updated_at' => new \DateTime("now")
        );
        
        $this->assertEquals($result,$array);
    }
    
    public function test_verifica_hydrator_no_construtor()
    {
        $array = array(
          'id' => 1,
            'nome' => 'Tarefa',
           'descricao' => 'Descricao da tarefa',
            'status'=>true,
            'created_at' => new \DateTime("now"),
            'updated_at' => new \DateTime("now")
        );
        
        $class = new Task($array);
        
        $this->assertEquals($array, $class->toArray());
        
    }
}
