package controle;

import converter.ConverterGenerico;
import entidade.PessoaJuridica;
import entidade.Cidade;
import facade.PessoaJuridicaFacade;
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
@ManagedBean(name = "pessoaJuridicaControle")
public class PessoaJuridicaControle implements Serializable{
    
    private PessoaJuridica pessoaJuridica;
    @EJB
    private PessoaJuridicaFacade pessoaJuridicaFacade;
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
        pessoaJuridicaFacade.salvar(pessoaJuridica);
    }
    
    public void novo(){
        pessoaJuridica = new PessoaJuridica();
    }

    public PessoaJuridica getPessoaJuridica() {
        return pessoaJuridica;
    }

    public void setPessoaJuridica(PessoaJuridica pessoaJuridica) {
        this.pessoaJuridica = pessoaJuridica;
    }
    
    
    
}
