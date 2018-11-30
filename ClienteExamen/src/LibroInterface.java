import retrofit2.Call;
import retrofit2.http.*;

import java.util.List;

/**
 * Created by adeborja on 30/11/18.
 */
public interface LibroInterface {

    /*@GET("/libro")
    Call<List<Libro>> getResult();

    @GET("/libro")
    Call<List<Libro>> getResultQuery(@Query("titulo") int query);*/

    @GET("/libro/{id}")
    Call<Libro> getLibro(@Path("id") int id);

    @GET("/libro/{id}/capitulo")
    //Call<Libro> getResult();

    @GET("/libro/{id}/capitulo/{id}")
    //Call<Libro> getResult();

}
