import retrofit2.Call;
import retrofit2.http.*;

import java.util.List;


public interface LibroInterface {

    @GET("/libro/{id}")
    Call<Libro> getLibro(@Path("id") int id);

    @GET("/libro")
    Call<List<Libro>> getLibros();

    @GET("/libro")
    Call<List<Libro>> getLibroParametros(@Query("minpag") int minpag);

    @DELETE("/libro/{id}")
    Call<Void> deleteLibro(@Path("id") int id);

    @DELETE("/libro")
    Call<Void> deleteTodosLibros();

    @Headers({"Content-type:application/json"})
    @POST("/libro")
    Call<Void> postLibro(@Body Libro libro);

    @Headers({"Content-type:application/json"})
    @PUT("/libro/{id}")
    Call<Void> putLibro(@Body Libro libro, @Path("id") int id);

}
