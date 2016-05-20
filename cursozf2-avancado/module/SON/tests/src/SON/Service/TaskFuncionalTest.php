<?php

namespace SON\Service;

use SONBase\Test\TestCase;

class TaskFuncionalTest extends TestCase
{
    public function test_verifica_se_consegue_inserir()
    {
        $class = new Task($this->getEm());
        $data = array(
          'nome' => 'Tarefa',
          'descricao' => 'Descricao tarefa',
          'status' => true
        );
        
        $result = $class->insert($data);
        
        $this->assertInstanceOf('\SON\Entity\Task',$result);
        $this->assertEquals(1, $result->getId());
        
        $result = $class->insert($data);
        
        $this->assertInstanceOf('\SON\Entity\Task',$result);
        $this->assertEquals(2, $result->getId());
        
    }
    
    public function test_verifica_se_consegue_alterar_registro()
    {
        $class = new Task($this->getEm());
        $data = array(
          'nome' => 'Tarefa',
          'descricao' => 'Descricao tarefa',
          'status' => true
        );
        
        $result = $class->insert($data);
        
        $data = array('nome'=>'Tarefa alterada','id'=>1);
        
        $result = $class->update($data);
        
        $this->assertInstanceOf('\SON\Entity\Task',$result);
        
        $obj = $this->getEm()->getRepository('SON\Entity\Task')->find(1);
        $this->assertEquals('Tarefa alterada', $obj->getNome());
        
    }
    
    public function test_verifica_se_consegue_deletar_registro()
    {
        $class = new Task($this->getEm());
        $data = array(
          'nome' => 'Tarefa',
          'descricao' => 'Descricao tarefa',
          'status' => true
        );
        
        $result = $class->insert($data);
        
        $result = $class->delete(1);
        
        $obj = $this->getEm()->getRepository('SON\Entity\Task')->find(1);
        $this->assertEquals(null, $obj);
    }
}
