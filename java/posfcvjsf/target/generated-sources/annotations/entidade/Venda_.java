package entidade;

import java.util.Date;
import javax.annotation.Generated;
import javax.persistence.metamodel.ListAttribute;
import javax.persistence.metamodel.SingularAttribute;
import javax.persistence.metamodel.StaticMetamodel;

@Generated(value = "org.hibernate.jpamodelgen.JPAMetaModelEntityProcessor")
@StaticMetamodel(Venda.class)
public abstract class Venda_ {

	public static volatile SingularAttribute<Venda, Date> dataVenda;
	public static volatile SingularAttribute<Venda, Pessoa> pessoa;
	public static volatile ListAttribute<Venda, ItensVenda> itensVendas;
	public static volatile SingularAttribute<Venda, Double> valorTotal;
	public static volatile SingularAttribute<Venda, Long> id;

}

