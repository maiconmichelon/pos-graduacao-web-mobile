package controle;

import converter.ConverterGenerico;
import converter.MoneyConverter;
import entidade.ItensCompra;
import entidade.Produto;
import entidade.Compra;
import entidade.PessoaJuridica;
import facade.PessoaJuridicaFacade;
import facade.ProdutoFacade;
import facade.CompraFacade;
import java.io.Serializable;
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
public class CompraControle implements Serializable {

    private Compra compra;
    private ItensCompra itensCompra;
    @EJB
    private CompraFacade compraFacade;
    @EJB
    private PessoaJuridicaFacade pessoaJuridicaFacade;
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

    public List<PessoaJuridica> listaPessoas(String parte) {
        System.out.println("Lista pessoa");
        return pessoaJuridicaFacade.listaFiltrando(parte, "nome");
    }

    public List<Produto> listaProdutos(String parte) {
        return produtoFacade.listaFiltrando(parte, "nome");
    }

    public ConverterGenerico getPessoaConverter() {
        if (pessoaConverter == null) {
            pessoaConverter = new ConverterGenerico(pessoaJuridicaFacade);
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
        compraFacade.salvar(compra);
    }

    public void remover(Compra o) {
        compraFacade.remover(o);
    }

    public void addItem() {
        itensCompra.setCompra(compra);
        compra.getItensCompras().add(itensCompra);
        itensCompra = new ItensCompra();
    }

    public void removeItem(ItensCompra iv) {
        compra.getItensCompras().remove(iv);
    }

    public void novo() {
        compra = new Compra();
        itensCompra = new ItensCompra();
    }

    public List<Compra> getLista() {
        return compraFacade.listaTodos();
    }

    public Compra getCompra() {
        return compra;
    }

    public void setCompra(Compra compra) {
        this.compra = compra;
    }

    public ItensCompra getItensCompra() {
        return itensCompra;
    }

    public void setItensCompra(ItensCompra itensCompra) {
        this.itensCompra = itensCompra;
    }

}
