/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package controle;

import converter.ConverterGenerico;
import entidade.GrupoProduto;
import facade.GrupoProdutoFacade;
import java.io.Serializable;
import java.util.List;
import javax.ejb.EJB;
import javax.faces.bean.ManagedBean;
import javax.faces.bean.SessionScoped;
import org.primefaces.model.DefaultTreeNode;
import org.primefaces.model.TreeNode;

/**
 *
 * @author jaimedias
 */
@ManagedBean(name = "grupoProdutoControle")
@SessionScoped
public class GrupoProdutoControle implements Serializable{

    private GrupoProduto grupoProduto;
    @EJB
    private GrupoProdutoFacade grupoProdutoFacade;
    private ConverterGenerico converterGenerico;
    
    private TreeNode root1;
    private TreeNode noGrupo;
    
    public void iniciaArvore(){
        root1 = new DefaultTreeNode(new GrupoProduto("Raiz"), null);
        montaArvore(root1, grupoProdutoFacade.listaTodos());
    }
    
    public void montaArvore(TreeNode root, List<GrupoProduto> lista){        
        TreeNode no = null;
        for (GrupoProduto grupo : lista) {
            if (grupo.getGrupoProduto() == null) {
                TreeNode treeNode = new DefaultTreeNode(grupo, root);
                treeNode.setExpanded(true);
                no = treeNode;
            } else {
                TreeNode treeNode = new DefaultTreeNode(grupo, getPai(grupo, no));
                treeNode.setExpanded(true);
            }
        }
    }

    private TreeNode getPai(GrupoProduto grupo, TreeNode root) {
        GrupoProduto no = (GrupoProduto) root.getData();
        if (no.equals(grupo.getGrupoProduto())) {
            return root;
        }
        for (TreeNode treeNode : root.getChildren()) {
            TreeNode pai = getPai(grupo, treeNode);
            GrupoProduto grupoPai = (GrupoProduto) pai.getData();
            if (grupoPai.equals(grupo.getGrupoProduto())) {
                pai.setSelectable(true);
                return pai;
            }
        }
        return root;
    }

    public TreeNode getRoot1() {
        return root1;
    }

    public void setRoot1(TreeNode root1) {
        this.root1 = root1;
    }

    public TreeNode getNoGrupo() {
        return noGrupo;
    }

    public void setNoGrupo(TreeNode noGrupo) {
        this.noGrupo = noGrupo;
    }

    public ConverterGenerico getConverterGenerico() {
        if(converterGenerico == null){
            converterGenerico = new ConverterGenerico(grupoProdutoFacade);
        }
        return converterGenerico;
    }

    public void setConverterGenerico(ConverterGenerico converterGenerico) {
        this.converterGenerico = converterGenerico;
    }

    public void novo() {
        grupoProduto = new GrupoProduto();
        iniciaArvore();
    }

    public void editar(GrupoProduto e) {
        grupoProduto = e;
    }

    public void remover(GrupoProduto e) {
        grupoProduto = e;
        grupoProdutoFacade.remover(grupoProduto);
    }

    public void salvar() {
        if(noGrupo != null){
            grupoProduto.setGrupoProduto((GrupoProduto)noGrupo.getData());
        }        
        grupoProdutoFacade.salvar(grupoProduto);
    }

    public List<GrupoProduto> listaTodos() {
        return grupoProdutoFacade.listaTodos();
    }

    public GrupoProduto getGrupoProduto() {
        return grupoProduto;
    }

    public void setGrupoProduto(GrupoProduto grupoProduto) {
        this.grupoProduto = grupoProduto;
    }

}
