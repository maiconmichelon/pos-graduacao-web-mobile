/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package facade;

import entidade.Cidade;
import entidade.ItensVenda;
import entidade.Produto;
import entidade.Venda;
import javax.ejb.Stateless;
import javax.persistence.EntityManager;
import javax.persistence.PersistenceContext;

/**
 *
 * @author jaimedias
 */
@Stateless
public class VendaFacade extends AbstractFacade<Venda>{
    @PersistenceContext(name = "posfcvjsfPU")
    private EntityManager em;
    
    @Override
    protected EntityManager getEntityManager() {
        return em;
    }

    public VendaFacade() {
        super(Venda.class);
    }
    
    @Override
    public void remover(Venda venda) {
        ajustaEstoque(venda);
        super.remover(venda);
    }
    
    private void ajustaEstoque(Venda entity) {
        for(ItensVenda iv : entity.getItensVendas()){
            Produto p = iv.getProduto();
            p.setEstoque(p.getEstoque() + iv.getQuantidade());
            em.merge(p);
        }
    }

    @Override
    public void salvar(Venda entity) {
        baixaestoque(entity);
        em.merge(entity);
    }

    private void baixaestoque(Venda entity) {
        for(ItensVenda iv : entity.getItensVendas()){
            Produto p = iv.getProduto();
            p.setEstoque(p.getEstoque() - iv.getQuantidade());
            em.merge(p);
        }
    }
    
}
