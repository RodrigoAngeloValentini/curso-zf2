<?php

namespace Admin\Model;

class CorreiosCalculoFrete
{
    // Código e senha da empresa, se você tiver contrato com os correios, se não tiver deixe vazio.
    public $nCdEmpresa = '';
    public $sDsSenha = '';

    // CEP de origem e destino. Esse parametro precisa ser numérico, sem "-" (hífen) espaços ou algo diferente de um número.
    public $sCepOrigem = '83823273';
    public $sCepDestino;

    // O peso do produto deverá ser enviado em quilogramas, leve em consideração que isso deverá incluir o peso da embalagem.
    public $nVlPeso = 0;

    // O formato tem apenas duas opções: 1 para caixa / pacote e 2 para rolo/prisma.
    public $nCdFormato = '1';

    // O comprimento, altura, largura e diametro deverá ser informado em centímetros e somente números
    public $nVlComprimento = '0';
    public $nVlAltura = '0';
    public $nVlLargura = '0';
    public $nVlDiametro = '0';

    // Aqui você informa se quer que a encomenda deva ser entregue somente para uma determinada pessoa após confirmação por RG. Use "s" e "n".
    public $sCdMaoPropria = 'n';

    // O valor declarado serve para o caso de sua encomenda extraviar, então você poderá recuperar o valor dela. Vale lembrar que o valor da encomenda interfere no valor do frete. Se não quiser declarar pode passar 0 (zero).
    public $nVlValorDeclarado = 0;

    // Se você quer ser avisado sobre a entrega da encomenda. Para não avisar use "n", para avisar use "s".
    public $sCdAvisoRecebimento = 'n';

    // Formato no qual a consulta será retornada, podendo ser: Popup é mostra uma janela pop-up - URL é envia os dados via post para a URL informada - XML é Retorna a resposta em XML
    public $StrRetorno = 'xml';

    // Código do Serviço, pode ser apenas um ou mais. Para mais de um apenas separe por virgula.
    public $nCdServico = '40010,41106';

    /**
     * @return string
     */
    public function getStrRetorno()
    {
        return $this->StrRetorno;
    }

    /**
     * @param string $StrRetorno
     */
    public function setStrRetorno($StrRetorno)
    {
        $this->StrRetorno = $StrRetorno;
        return $this;
    }

    /**
     * @return string
     */
    public function getNCdEmpresa()
    {
        return $this->nCdEmpresa;
    }

    /**
     * @param string $nCdEmpresa
     */
    public function setNCdEmpresa($nCdEmpresa)
    {
        $this->nCdEmpresa = $nCdEmpresa;
        return $this;
    }

    /**
     * @return string
     */
    public function getNCdFormato()
    {
        return $this->nCdFormato;
    }

    /**
     * @param string $nCdFormato
     */
    public function setNCdFormato($nCdFormato)
    {
        $this->nCdFormato = $nCdFormato;
        return $this;
    }

    /**
     * @return array
     */
    public function getNCdServico()
    {
        return $this->nCdServico;
    }

    /**
     * @param array $nCdServico
     */
    public function setNCdServico($nCdServico)
    {
        $this->nCdServico = $nCdServico;
        return $this;
    }

    /**
     * @return string
     */
    public function getNVlAltura()
    {
        return $this->nVlAltura;
    }

    /**
     * @param string $nVlAltura
     */
    public function setNVlAltura($nVlAltura)
    {
        $this->nVlAltura = $nVlAltura;
        return $this;
    }

    /**
     * @return string
     */
    public function getNVlComprimento()
    {
        return $this->nVlComprimento;
    }

    /**
     * @param string $nVlComprimento
     */
    public function setNVlComprimento($nVlComprimento)
    {
        $this->nVlComprimento = $nVlComprimento;
        return $this;
    }

    /**
     * @return string
     */
    public function getNVlDiametro()
    {
        return $this->nVlDiametro;
    }

    /**
     * @param string $nVlDiametro
     */
    public function setNVlDiametro($nVlDiametro)
    {
        $this->nVlDiametro = $nVlDiametro;
        return $this;
    }

    /**
     * @return string
     */
    public function getNVlLargura()
    {
        return $this->nVlLargura;
    }

    /**
     * @param string $nVlLargura
     */
    public function setNVlLargura($nVlLargura)
    {
        $this->nVlLargura = $nVlLargura;
        return $this;
    }

    /**
     * @return string
     */
    public function getNVlPeso()
    {
        return $this->nVlPeso;
    }

    /**
     * @param string $nVlPeso
     */
    public function setNVlPeso($nVlPeso)
    {
        $this->nVlPeso = $nVlPeso;
        return $this;
    }

    /**
     * @return string
     */
    public function getNVlValorDeclarado()
    {
        return $this->nVlValorDeclarado;
    }

    /**
     * @param string $nVlValorDeclarado
     */
    public function setNVlValorDeclarado($nVlValorDeclarado)
    {
        $this->nVlValorDeclarado = $nVlValorDeclarado;
        return $this;
    }

    /**
     * @return string
     */
    public function getSCdAvisoRecebimento()
    {
        return $this->sCdAvisoRecebimento;
    }

    /**
     * @param string $sCdAvisoRecebimento
     */
    public function setSCdAvisoRecebimento($sCdAvisoRecebimento)
    {
        $this->sCdAvisoRecebimento = $sCdAvisoRecebimento;
        return $this;
    }

    /**
     * @return string
     */
    public function getSCdMaoPropria()
    {
        return $this->sCdMaoPropria;
    }

    /**
     * @param string $sCdMaoPropria
     */
    public function setSCdMaoPropria($sCdMaoPropria)
    {
        $this->sCdMaoPropria = $sCdMaoPropria;
        return $this;
    }

    /**
     * @return string
     */
    public function getSCepDestino()
    {
        return $this->sCepDestino;
    }

    /**
     * @param string $sCepDestino
     */
    public function setSCepDestino($sCepDestino)
    {
        $this->sCepDestino = $sCepDestino;
        return $this;
    }

    /**
     * @return string
     */
    public function getSCepOrigem()
    {
        return $this->sCepOrigem;
    }

    /**
     * @param string $sCepOrigem
     */
    public function setSCepOrigem($sCepOrigem)
    {
        $this->sCepOrigem = $sCepOrigem;
        return $this;
    }

    /**
     * @return string
     */
    public function getSDsSenha()
    {
        return $this->sDsSenha;
    }

    /**
     * @param string $sDsSenha
     */
    public function setSDsSenha($sDsSenha)
    {
        $this->sDsSenha = $sDsSenha;
        return $this;
    }

} 