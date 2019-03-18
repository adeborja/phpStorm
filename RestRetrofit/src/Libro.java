import com.google.gson.annotations.SerializedName;

public class Libro {
	//Aqui se puede serializar un nombre para que sea igual que el que se
	//especifica en la API a la que vamos a conectar, ya que si el atributo
	//se llama de forma diferente, su contenido no será guardado
	@SerializedName(value = "codigo")
	private int codigo1;
	//private String createdAt;
	//private String updatedAt;
	private String titulo;
	private String numpag;

	
	public int getCodigo() {
		return codigo1;
	}
	public void setCodigo(int codigo) {
		this.codigo1 = codigo;
	}
	public String getNumpag() {
		return numpag;
	}
	public void setNumpag(String numpag) {
		this.numpag = numpag;
	}
	public String getTitulo() {
		return titulo;
	}
	public void setTitulo(String titulo) {
		this.titulo = titulo;
	}

	
	

}
