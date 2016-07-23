package controle;

import converter.ConverterGenerico;
import converter.EstadoConverter;
import entidade.Cidade;
import entidade.Estado;
import facade.CidadeFacade;
import facade.EstadoFacade;
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
@ManagedBean
public class CidadeControle implements Serializable{
    
    private Cidade cidade;
    @EJB
    private CidadeFacade cidadeFacade;
    @EJB
    private EstadoFacade estadoFacade;
    private ConverterGenerico estadoConverter;
    
    public List<Estado> listaEstados(){
        return estadoFacade.listaTodos();
    }

    public ConverterGenerico getEstadoConverter() {
        if(estadoConverter == null){
            estadoConverter = new ConverterGenerico(estadoFacade);
        }
        return estadoConverter;
    }

    public void setEstadoConverter(ConverterGenerico estadoConverter) {
        this.estadoConverter = estadoConverter;
    }
    
    public void salvar(){
        cidadeFacade.salvar(cidade);
    }
    
    public void remover(Cidade o){
        cidadeFacade.remover(o);
    }
    
    public void novo(){
        cidade = new Cidade();
    }

    public List<Cidade> getLista(){
        return cidadeFacade.listaTodos();
    }

    public Cidade getCidade() {
        return cidade;
    }

    public void setCidade(Cidade cidade) {
        this.cidade = cidade;
    }
    
    
    
}
