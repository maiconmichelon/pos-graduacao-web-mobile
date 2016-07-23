package controle;

import converter.ConverterGenerico;
import converter.MoneyConverter;
import entidade.ItensVenda;
import entidade.Pessoa;
import entidade.Produto;
import entidade.Venda;
import facade.PessoaFacade;
import facade.PessoaFisicaFacade;
import facade.PessoaJuridicaFacade;
import facade.ProdutoFacade;
import facade.VendaFacade;
import java.io.Serializable;
import java.util.ArrayList;
import java.util.List;
import javax.ejb.EJB;
import javax.faces.application.FacesMessage;
import javax.faces.bean.ManagedBean;
import javax.faces.bean.SessionScoped;
import javax.faces.context.FacesContext;

/**
 *
 * @author jaimedias
 */
@SessionScoped
@ManagedBean
public class VendaControle implements Serializable {

    private Venda venda;
    private ItensVenda itensVenda;
    @EJB
    private VendaFacade vendaFacade;
    @EJB
    private PessoaFacade pessoaFacade;
    @EJB
    private ProdutoFacade produtoFacade;
    private ConverterGenerico pessoaConverter;
    private ConverterGenerico produtoConverter;
    private MoneyConverter moneyConverter;

    public MoneyConverter getMoneyConverter() {
        if (moneyConverter == null) {
            moneyConverter = new MoneyConverter();
        }
        return moneyConverter;
    }

    public void setMoneyConverter(MoneyConverter moneyConverter) {
        this.moneyConverter = moneyConverter;
    }

    public List<Pessoa> listaPessoas(String parte) {
        System.out.println("Lista pessoa");
        return pessoaFacade.listaFiltrando(parte, "nome");
    }

    public List<Produto> listaProdutos(String parte) {
        return produtoFacade.listaFiltrando(parte, "nome");
    }

    public ConverterGenerico getPessoaConverter() {
        if (pessoaConverter == null) {
            pessoaConverter = new ConverterGenerico(pessoaFacade);
        }
        return pessoaConverter;
    }

    public void setPessoaConverter(ConverterGenerico pessoaConverter) {
        this.pessoaConverter = pessoaConverter;
    }

    public ConverterGenerico getProdutoConverter() {
        if (produtoConverter == null) {
            produtoConverter = new ConverterGenerico(produtoFacade);
        }
        return produtoConverter;
    }

    public void setProdutoConverter(ConverterGenerico produtoConverter) {
        this.produtoConverter = produtoConverter;
    }

    public void salvar() {
        vendaFacade.salvar(venda);
    }

    public void remover(Venda o) {
        vendaFacade.remover(o);
    }

    public void addItem() {
        Double estoque = itensVenda.getProduto().getEstoque();
        for(ItensVenda iv : venda.getItensVendas()){
            if(itensVenda.getProduto().equals(iv.getProduto())){
                estoque = estoque - iv.getQuantidade();
            }
        }
        if (estoque < itensVenda.getQuantidade()) {
            FacesContext.getCurrentInstance().addMessage(
                    null,
                    new FacesMessage(
                            FacesMessage.SEVERITY_ERROR,
                            "Estoque insuficiente!",
                            "Restam apenas " + estoque + " unidades!"
                    ));
        } else {
            itensVenda.setPreco(itensVenda.getProduto().getPreco());
            itensVenda.setVenda(venda);
            venda.getItensVendas().add(itensVenda);
            itensVenda = new ItensVenda();
        }

    }

    public void removeItem(ItensVenda iv) {
        venda.getItensVendas().remove(iv);
    }

    public void novo() {
        venda = new Venda();
        itensVenda = new ItensVenda();
    }

    public List<Venda> getLista() {
        return vendaFacade.listaTodos();
    }

    public Venda getVenda() {
        return venda;
    }

    public void setVenda(Venda venda) {
        this.venda = venda;
    }

    public ItensVenda getItensVenda() {
        return itensVenda;
    }

    public void setItensVenda(ItensVenda itensVenda) {
        this.itensVenda = itensVenda;
    }

}
