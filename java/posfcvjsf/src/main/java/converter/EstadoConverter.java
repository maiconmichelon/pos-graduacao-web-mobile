/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package converter;

import entidade.Estado;
import facade.EstadoFacade;
import javax.faces.component.UIComponent;
import javax.faces.context.FacesContext;
import javax.faces.convert.Converter;

/**
 *
 * @author jaimedias
 */
public class EstadoConverter implements Converter{

    private EstadoFacade estadoFacade;
    
    public EstadoConverter(EstadoFacade estadoFacade){
        this.estadoFacade = estadoFacade;
    }
    
    @Override
    public Object getAsObject(FacesContext context, UIComponent component, String value) {
        return (Estado)estadoFacade.buscar(Long.parseLong(value));
    }

    @Override
    public String getAsString(FacesContext context, UIComponent component, Object value) {
        return ((Estado)value).getId().toString();
    }
    
}
