/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package controle;

import entidade.Pessoa;
import entidade.PessoaFisica;
import entidade.PessoaJuridica;
import facade.PessoaFisicaFacade;
import facade.PessoaJuridicaFacade;
import java.util.ArrayList;
import java.util.List;
import javax.ejb.EJB;
import javax.faces.bean.ManagedBean;
import javax.faces.bean.ManagedProperty;
import javax.faces.bean.SessionScoped;

/**
 *
 * @author jaimedias
 */
@ManagedBean
@SessionScoped
public class PessoaControle {
    @EJB
    private PessoaFisicaFacade pessoaFisicaFacade;
    @EJB
    private PessoaJuridicaFacade pessoaJuridicaFacade;
    
    @ManagedProperty(value = "#{pessoaFisicaControle}")
    private PessoaFisicaControle pessoaFisicaControle;
    @ManagedProperty(value = "#{pessoaJuridicaControle}")
    private PessoaJuridicaControle pessoaJuridicaControle;
    
    public List<Pessoa> listaPessoas(){
        List<Pessoa> retorno = new ArrayList<>();
        retorno.addAll(pessoaFisicaFacade.listaTodos());
        retorno.addAll(pessoaJuridicaFacade.listaTodos());
        return retorno;
    }
    
    public void remover(Pessoa p){
        if(p instanceof PessoaFisica){
            pessoaFisicaFacade.remover((PessoaFisica)p);
        }else{
            pessoaJuridicaFacade.remover((PessoaJuridica)p);
        }            
    }
    
    public String editar(Pessoa p){
        if(p instanceof PessoaFisica){
            pessoaFisicaControle.setPessoaFisica((PessoaFisica)p);
            return "pessoafisicaedita";
        }else{
            pessoaJuridicaControle.setPessoaJuridica((PessoaJuridica)p);
            return "pessoajuridicaedita";
        }            
    }

    public PessoaFisicaControle getPessoaFisicaControle() {
        return pessoaFisicaControle;
    }

    public void setPessoaFisicaControle(PessoaFisicaControle pessoaFisicaControle) {
        this.pessoaFisicaControle = pessoaFisicaControle;
    }

    public PessoaJuridicaControle getPessoaJuridicaControle() {
        return pessoaJuridicaControle;
    }

    public void setPessoaJuridicaControle(PessoaJuridicaControle pessoaJuridicaControle) {
        this.pessoaJuridicaControle = pessoaJuridicaControle;
    }

    
    
}
