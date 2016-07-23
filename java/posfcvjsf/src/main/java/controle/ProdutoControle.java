/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package controle;

import converter.ConverterGenerico;
import converter.MoneyConverter;
import entidade.GrupoProduto;
import entidade.ItensVenda;
import entidade.Produto;
import facade.GrupoProdutoFacade;
import facade.ProdutoFacade;
import java.util.List;
import javax.ejb.EJB;
import javax.faces.bean.ManagedBean;
import javax.faces.bean.ManagedProperty;
import javax.faces.bean.SessionScoped;
import org.primefaces.model.DefaultTreeNode;
import org.primefaces.model.TreeNode;

/**
 *
 * @author jaimedias
 */
@ManagedBean
@SessionScoped
public class ProdutoControle {

    private Produto produto;
    @EJB
    private ProdutoFacade produtoFacade;
    @EJB
    private GrupoProdutoFacade grupoProdutoFacade;
    @ManagedProperty(value = "#{grupoProdutoControle}")
    private GrupoProdutoControle grupoProdutoControle;
    private ConverterGenerico converterGenerico;
    private TreeNode noGrupo;
    private MoneyConverter moneyConverter;

    public MoneyConverter getMoneyConverter() {
        if(moneyConverter == null){
            moneyConverter = new MoneyConverter();
        }
        return moneyConverter;
    }

    public void setMoneyConverter(MoneyConverter moneyConverter) {
        this.moneyConverter = moneyConverter;
    }

    public TreeNode getNoGrupo() {
        return noGrupo;
    }

    public void setNoGrupo(TreeNode noGrupo) {
        this.noGrupo = noGrupo;
    }

    public ConverterGenerico getConverterGenerico() {
        if (converterGenerico == null) {
            converterGenerico = new ConverterGenerico(grupoProdutoFacade);
        }
        return converterGenerico;
    }

    public void setConverterGenerico(ConverterGenerico converterGenerico) {
        this.converterGenerico = converterGenerico;
    }

    public void novo() {
        produto = new Produto();
        grupoProdutoControle.iniciaArvore();
    }

    public void editar(Produto e) {
        produto = e;
    }

    public void remover(Produto e) {
        produto = e;
        produtoFacade.remover(produto);
    }

    public void salvar() {
        if (noGrupo != null) {
            produto.setGrupoProduto((GrupoProduto) noGrupo.getData());
        }
        produtoFacade.salvar(produto);
    }

    public List<Produto> listaTodos() {
        return produtoFacade.listaTodos();
    }

    public Produto getProduto() {
        return produto;
    }

    public void setProduto(Produto produto) {
        this.produto = produto;
    }

    public GrupoProdutoControle getGrupoProdutoControle() {
        return grupoProdutoControle;
    }

    public void setGrupoProdutoControle(GrupoProdutoControle grupoProdutoControle) {
        this.grupoProdutoControle = grupoProdutoControle;
    }

}
