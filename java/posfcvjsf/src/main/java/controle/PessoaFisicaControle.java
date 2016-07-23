package controle;

import converter.ConverterGenerico;
import entidade.PessoaFisica;
import entidade.Cidade;
import facade.PessoaFisicaFacade;
import facade.CidadeFacade;
import java.io.Serializable;
import java.util.List;
import javax.ejb.EJB;
import javax.faces.bean.ManagedBean;
import javax.faces.bean.SessionScoped;

/**
 *
 * @author jaimedias
 */
@SessionScoped
@ManagedBean(name = "pessoaFisicaControle")
public class PessoaFisicaControle implements Serializable{
    
    private PessoaFisica pessoaFisica;
    @EJB
    private PessoaFisicaFacade pessoaFisicaFacade;
    @EJB
    private CidadeFacade cidadeFacade;
    private ConverterGenerico cidadeConverter;
    
    public List<Cidade> listaCidades(String parte){
        return cidadeFacade.listaFiltrando(parte, "nome");
    }

    public ConverterGenerico getCidadeConverter() {
        if(cidadeConverter == null){
            cidadeConverter = new ConverterGenerico(cidadeFacade);
        }
        return cidadeConverter;
    }

    public void setCidadeConverter(ConverterGenerico cidadeConverter) {
        this.cidadeConverter = cidadeConverter;
    }
    
    public void salvar(){
        pessoaFisicaFacade.salvar(pessoaFisica);
    }
    
    public void novo(){
        pessoaFisica = new PessoaFisica();
    }

    public PessoaFisica getPessoaFisica() {
        return pessoaFisica;
    }

    public void setPessoaFisica(PessoaFisica pessoaFisica) {
        this.pessoaFisica = pessoaFisica;
    }
    
    
    
}
