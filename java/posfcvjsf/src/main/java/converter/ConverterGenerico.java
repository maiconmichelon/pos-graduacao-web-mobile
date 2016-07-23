/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package converter;

import entidade.BaseEntidade;
import facade.AbstractFacade;
import javax.faces.component.UIComponent;
import javax.faces.context.FacesContext;
import javax.faces.convert.Converter;

/**
 *
 * @author jaimedias
 */
public class ConverterGenerico implements Converter{

    private AbstractFacade abstractFacade;
    
    public ConverterGenerico(AbstractFacade abstractFacade){
        this.abstractFacade = abstractFacade;
    }
    
    @Override
    public Object getAsObject(FacesContext context, UIComponent component, String value) {
        System.out.println("GetAsObject: " +value);
        return abstractFacade.buscar(Long.parseLong(value));
    }

    @Override
    public String getAsString(FacesContext context, UIComponent component, Object value) {
        System.out.println("GetAsString : " +value);
        return ((BaseEntidade)value).getId().toString();
    }
    
}
