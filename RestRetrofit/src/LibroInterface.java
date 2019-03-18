import retrofit2.Call;
import retrofit2.http.*;

import java.util.List;


public interface LibroInterface {
	@GET("/libro/{codigo}")
	Call<Libro> getLibro(@Path("codigo") int codigo);

	@GET("/libro")
	Call<List<Libro>> getLibro();

	@POST("/libro")
    @FormUrlEncoded
    Call<Libro> postLibro(@Field("titulo") String titulo, @Field("codigo") int codigo, @Field("numpag") String numpag);
    //Call<Libro> postLibro(@Body Libro libro);

}
