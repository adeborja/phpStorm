import retrofit2.Call;
import retrofit2.http.*;

import java.util.List;


public interface LibroInterface {

	@GET("/libro")
	Call<List<Libro>> getResult();

	@GET("/libro")
	Call<List<Libro>> getResultQuery(@Query("minpag") int query);

	@DELETE("/libro/{id}")
	Call<Void> deleteLibro(@Path("id") int id);

	@Headers({"Content-type:application/json"})
	@POST("/libro")
	Call<Void> postLibro(@Body Libro libro);


	@Headers({"Content-type:application/json"})
	@PUT("/libro/{id}")
	Call<Void> putLibro(@Path("id")int id,@Body Libro libro);
}
