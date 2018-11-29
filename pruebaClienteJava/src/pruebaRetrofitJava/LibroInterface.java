package pruebaRetrofitJava;
import retrofit2.Call;
import retrofit2.http.GET;
import retrofit2.http.Path;

import java.util.List;


public interface LibroInterface {
	@GET("libro/{id}")
	Call<Libro> getLibro (@Path("id") int id);

	@GET("libro")
	Call<List<Libro>> getLibro ();

}
