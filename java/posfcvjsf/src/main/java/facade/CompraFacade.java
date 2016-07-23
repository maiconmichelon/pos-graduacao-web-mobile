/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package facade;

import entidade.ItensCompra;
import entidade.Produto;
import entidade.Compra;
import javax.ejb.Stateless;
import javax.persistence.EntityManager;
import javax.persistence.PersistenceContext;

/**
 *
 * @author jaimedias
 */
@Stateless
public class CompraFacade extends AbstractFacade<Compra>{
    @PersistenceContext(name = "posfcvjsfPU")
    private EntityManager em;
    
    @Override
    protected EntityManager getEntityManager() {
        return em;
    }

    public CompraFacade() {
        super(Compra.class);
    }
    
    @Override
    public void remover(Compra compra) {
        ajustaEstoque(compra);
        super.remover(compra);
    }
    
    private void ajustaEstoque(Compra compra) {
        for(ItensCompra ic : compra.getItensCompras()){
            Produto p = ic.getProduto();
            p.setEstoque(p.getEstoque() - ic.getQuantidade());
            em.merge(p);
        }
    }

    @Override
    public void salvar(Compra entity) {
        baixaestoque(entity);
        em.merge(entity);
    }

    private void baixaestoque(Compra entity) {
        for(ItensCompra ic : entity.getItensCompras()){
            Produto p = ic.getProduto();
            p.setEstoque(p.getEstoque() + ic.getQuantidade());
            em.merge(p);
        }
    }
    
}
