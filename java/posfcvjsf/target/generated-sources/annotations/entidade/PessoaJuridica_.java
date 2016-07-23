package entidade;

import javax.annotation.Generated;
import javax.persistence.metamodel.SingularAttribute;
import javax.persistence.metamodel.StaticMetamodel;

@Generated(value = "org.hibernate.jpamodelgen.JPAMetaModelEntityProcessor")
@StaticMetamodel(PessoaJuridica.class)
public abstract class PessoaJuridica_ extends entidade.Pessoa_ {

	public static volatile SingularAttribute<PessoaJuridica, String> nomeFantasia;
	public static volatile SingularAttribute<PessoaJuridica, String> cnpj;
	public static volatile SingularAttribute<PessoaJuridica, String> ie;

}

