<?php

namespace Application\Controller;

use Admin\Service\CalculoFrete;
use JVKart\Model\BaseItems;
use JVKart\Service\KartProduct;
use Zend\Json\Json;
use Zend\View\Model\ViewModel;

class CarrinhoController extends AbstractController
{
    protected $kart;

    public function listarAction()
    {
        $this->layout('layout/layout_produto_detalhe');

        // instancia o carrinho de compras
        $kart = $this->getKart();

        return new ViewModel(array(
            'itens' => $kart->getItemsArray(),
            'cupom' => $kart->getCupomBonus(),
            'discountCode' => $kart->getDiscountCode(),
            'frete' => $kart->getShipping()
        ));
    }

    public function adicionarAction()
    {
        $request = $this->getRequest();
        if ($request->isPost()) {
            $dados = $request->getPost()->toArray();
            $idProduto = (isset($dados['produto']) && $dados['produto'] > 0) ? $dados['produto'] : 0;
            $atributos = array();
            $atributos['cor'] = (isset($dados['atributo_cor']) && $dados['atributo_cor'] > 0) ? $dados['atributo_cor'] : 0;
            $atributos['tamanho'] = (isset($dados['atributo_tamanho']) && $dados['atributo_tamanho'] > 0) ? $dados['atributo_tamanho'] : 0;
            $produto = $this->getEm('Admin\Entity\Produto')->find($idProduto);

            // instancia o carrinho de compras
            $kart = $this->getKart();

            $repositoryPreco = $this->getEm('Admin\Entity\Preco');
            $preco = $repositoryPreco->getPreco($produto->getId());
            if (count($preco)) {
                if (isset($preco['precoNovo'])) {
                    $precoProduto = $preco['precoNovo'];
                } else {
                    $precoProduto = $preco['precoAtual'];
                }
            } else {
                $this->flashMessenger()->addMessage(array('danger' => 'Este produto não pode ser adicionado no carrinho'));
                return $this->redirect()->toRoute('carrinho_listar');
            }

            $modelProduto = new BaseItems();
            $modelProduto
                ->setId($produto->getId())
                ->setProductCode($produto->getCodigo())
                ->setIdCategory($produto->getCategoria()->getId())
                ->setNameCategory($produto->getCategoria()->getNome())
                ->setDescription($produto->getNome())
                ->setPrice($precoProduto)
                ->setSlug($produto->getSlug())
                ->setQuantity($dados['quantity'])
                ->setImage($produto->getFoto()[0]->getArquivo())
                ->setAttributes($atributos)
            ;

            $kart->setSumDuplicateAddItem(false);

            try {
                $kart->add($modelProduto);
            } catch(\Exception $e) {
                $this->flashMessenger()->addMessage(array('info' => $e->getMessage()));
            }

            return $this->redirect()->toRoute('carrinho_listar');
        }

    }

    public function limparAction()
    {
        // instancia o carrinho de compras
        $kart = $this->getKart();

        $kart->clear();

        return $this->redirect()->toRoute('carrinho_listar');
    }

    public function removeAction()
    {
        // instancia o carrinho de compras
        $kart = $this->getKart();

        $id = (int) $this->params('id');

        $kart->delete($id);

        $this->flashMessenger()->addMessage(array('successo' => 'Produto removido com sucesso!'));
        return $this->redirect()->toRoute('carrinho_listar');
    }

    public function aplicarCupomAction()
    {
        $kart = $this->getKart();
        $request = $this->getRequest();

        if ($request->isPost()) {
            $codigo = $request->getPost()['cupom'];

            $cupom = $this->getEm('Admin\Entity\Cupom')->findOneByCodigo($codigo);
            if ($cupom) {
                $dataNow = new \DateTime('now');
                $dataAtual = $dataNow->format('YmdHis');
                $dataIni = $cupom->getDtaIni()->format('YmdHis');
                $dataFim = $cupom->getDtaFim()->format('YmdHis');

                if (!(($dataAtual > $dataIni) && ($dataAtual < $dataFim))) {
                    $this->flashMessenger()->addMessage(array('danger' => 'Cupom vencido!'));
                    return $this->redirect()->toRoute('carrinho_listar');
                }

                if ($cupom->getTipo() == 2) {
                    $totalCarrinho = $kart->getTotalPrice();
                    if ($cupom->getTipoDesconto() == 1) {
                        $valorBonus = $cupom->getValor();
                    } elseif($cupom->getTipoDesconto() == 2) {
                        $valorBonus = ($totalCarrinho * ($cupom->getValor() / 100));
                    }
                }
            }

            if (!$kart->getDiscountCode()) {
                $kart->setDiscountCode($codigo);
                $kart->setCupomBonus($valorBonus);
            } else {
                $this->flashMessenger()->addMessage(array('info' => 'Já foi adicionado um cupom de desconto!'));
            }
        }

        return $this->redirect()->toRoute('carrinho_listar');
    }

    public function calculoFreteAction()
    {
        $request = $this->getRequest();
        $params = array();

        if ($request->isPost()) {
            $cep = $request->getPost()['cep'];
            $params['sCepDestino'] = $cep;
            $params['nVlPeso'] = 0.3;
            $params['nVlComprimento'] = '25';
            $params['nVlAltura'] = '7';
            $params['nVlLargura'] = '12';

            $calculoFrete = new CalculoFrete();
            $dados = $calculoFrete->correiosCalculoFrete($params);
        }

        return $this->getResponse()->setContent(Json::encode($dados));
    }

    public function adicionarFreteAction()
    {
        $kart = $this->getKart();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $dados = $request->getPost()->toArray();
            $valorFrete = str_replace(",", ".", $dados['valor_frete']);
            $codigoFrete = $dados['codigo_frete'];
            $kart->setShipping($codigoFrete, $valorFrete);

            $this->flashMessenger()->addMessage(array('success' => 'O frete foi calculado com sucesso!'));
            return $this->redirect()->toRoute('carrinho_listar');
        }
    }

    public function getKart()
    {
        if (null === $this->kart) {
            $this->kart = new KartProduct('kart');
        }

        return $this->kart;
    }
} 