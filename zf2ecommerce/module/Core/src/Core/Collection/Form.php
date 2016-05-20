<?php

namespace Core\Collection;

class Form 
{
	public function getEstados() 
	{
		$estados = array(
			"AC"=>"Acre", 
			"AL"=>"Alagoas", 
			"AM"=>"Amazonas", 
			"AP"=>"Amapá",
			"BA"=>"Bahia",
			"CE"=>"Ceará",
			"DF"=>"Distrito Federal",
			"ES"=>"Espírito Santo",
			"GO"=>"Goiás",
			"MA"=>"Maranhão",
			"MT"=>"Mato Grosso",
			"MS"=>"Mato Grosso do Sul",
			"MG"=>"Minas Gerais",
			"PA"=>"Pará",
			"PB"=>"Paraíba",
			"PR"=>"Paraná",
			"PE"=>"Pernambuco",
			"PI"=>"Piauí",
			"RJ"=>"Rio de Janeiro",
			"RN"=>"Rio Grande do Norte",
			"RO"=>"Rondônia",
			"RS"=>"Rio Grande do Sul",
			"RR"=>"Roraima",
			"SC"=>"Santa Catarina",
			"SE"=>"Sergipe",
			"SP"=>"São Paulo",
			"TO"=>"Tocantins");
		
		return $estados;
	}
}