import retrofit2.Call;
import retrofit2.http.*;

import java.util.List;


public interface UsuarioInterface {
	@POST("/usuario?XDEBUG_SESSION_START=PHPSTORM")
	@Headers({"Content-Type: application/json"})
	Call<Void> postUsuario(@Body Usuario usuario);

	/*@GET("/libro?XDEBUG_SESSION_START=PHPSTORM")
	//@Headers({ "Authorization: Basic YW5nZWw6YXNk"})
	//@Headers({ "Authorization: Basic {auth}"})
	Call<List<Libro>> getLibro(@Header("Authorization") String auth);
	//TODO: ahora hay que hacer las clases necesarias para el manejo de usuarios, igual que con libros

	@POST("/libro")// /?XDEBUG_SESSION_START=PHPSTORM") //esto es para depurar en phpstorm
	@Headers({ "Content-Type: application/json"})
    Call<Void> postLibro(@Body Libro libro);

	@DELETE("/libro/{codigo}")
    Call<Void> deleteLibro(@Path("codigo") int codigo);

	//Mejor no añadirlo por seguridad. Raramente quieres borrarlo tod o.
	@DELETE("/libro")
    Call<Void> deleteLibro();

	@PUT("/libro/{codigo}")
    @Headers({ "Content-Type: application/json"})
    Call<Void> putLibro(@Path("codigo") int codigo, @Body Libro libro);*/

}
