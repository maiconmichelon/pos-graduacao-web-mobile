package controle;

import entidade.Estado;
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
public class EstadoControle implements Serializable{
    
    private Estado estado;
    @EJB
    private EstadoFacade estadoFacade;
    
    public void salvar(){
        estadoFacade.salvar(estado);
    }
    
    public void remover(Estado e){
        estadoFacade.remover(e);
    }
    
    public void novo(){
        estado = new Estado();
    }

    public List<Estado> getLista(){
        return estadoFacade.listaTodos();
    }

    public Estado getEstado() {
        return estado;
    }

    public void setEstado(Estado estado) {
        this.estado = estado;
    }
    
    
    
}
