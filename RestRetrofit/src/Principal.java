import java.io.IOException;
import com.google.gson.Gson;
import okio.*;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;





/***************************************
 * SE PUEDEN DESCARGAR JARS DE CONVERTIDORES DE AQUÍ:
 * http://search.maven.org/
 * 
 * Por ejemplo:
 * http://search.maven.org/#search%7Cga%7C1%7Cg%3A%22com.squareup.retrofit2%22
 * 
 * Si usamos gradle, simplemente añadiríamos la dependencia:
 * com.squareup.retrofit2:converter-gson/home/migue/Descargas/converter-gson-2.1.0.jar
 *
 */



public class Principal {
	
	private final static String SERVER_URL = "http://biblioteca.devel:8080";

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		
		Retrofit retrofit;
		LibroCallback libroCallback = new LibroCallback();
		ListaLibroCallback listaLibroCallback = new ListaLibroCallback();
		PostLibroCallback postLibroCallback = new PostLibroCallback();
		DeleteLibroCallback deleteLibroCallback = new DeleteLibroCallback();
		PutLibroCallback putLibroCallback = new PutLibroCallback();

		
		retrofit = new Retrofit.Builder()
							   .baseUrl(SERVER_URL)
							   .addConverterFactory(GsonConverterFactory.create())
							   .build();
		
		LibroInterface libroInter = retrofit.create(LibroInterface.class);

		//CREAR USUARIO
		PostUsuarioCallback postUsuarioCallback = new PostUsuarioCallback();
		UsuarioInterface usuarioInter = retrofit.create(UsuarioInterface.class);

		Usuario u = new Usuario();
		u.setUsername("angel");
		u.setPassword("asd");

		usuarioInter.postUsuario(u).enqueue(postUsuarioCallback);



		//con android
        //https://code.tutsplus.com/es/tutorials/sending-data-with-retrofit-2-http-client-for-android--cms-27845

        //stackov
        //https://stackoverflow.com/questions/28371305/no-retrofit-annotation-found-parameter-1
		
		//libroInter.getLibro(1).enqueue(libroCallback);
		/*String auth = "YW5nZWw6YXNk";
		libroInter.getLibro("Basic "+auth).enqueue(listaLibroCallback);*/


        /*Libro l = new Libro();
        l.setTitulo("libro retrofit");
        l.setNumpag("50");
        libroInter.postLibro(l).enqueue(postLibroCallback);*/

        //libroInter.deleteLibro(17).enqueue(deleteLibroCallback);

		//libroInter.deleteLibro().enqueue(deleteLibroCallback);

		/*Libro l = new Libro();
		l.setTitulo("libro retrofit modificado");
		l.setNumpag("503");
		l.setCodigo(17);
		libroInter.putLibro(l.getCodigo(), l).enqueue(putLibroCallback);*/

	}


	


}
