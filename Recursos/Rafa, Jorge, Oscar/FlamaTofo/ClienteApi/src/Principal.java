
import java.io.IOException;
import com.google.gson.Gson;
import okio.*;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.Converter.Factory.*;
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
	
	private final static String SERVER_URL = "http://libros.api:8080";

	public static void main(String[] args) {
		// TODO Auto-generated method stub

		Retrofit retrofit;
		LibroCallback libroCallback = new LibroCallback();
		LibroCallbackDelete delete = new LibroCallbackDelete();
		LibroCallBackPost post = new LibroCallBackPost();
		LibroCalbackPut put = new LibroCalbackPut();
		LibroCallbackQueryGet getQuery = new LibroCallbackQueryGet();
		Libro libro = new Libro();

		retrofit = new Retrofit.Builder()
							   .baseUrl(SERVER_URL)
							   .addConverterFactory(GsonConverterFactory.create())
							   .build();
		
		LibroInterface libroInter = retrofit.create(LibroInterface.class);
		
		//libroInter.getResult().enqueue(libroCallback);

		//libroInter.deleteLibro(2).enqueue(delete);
		//libroInter.postLibro(libro).enqueue(post);
		//libroInter.putLibro(2,libro).enqueue(put);
		libroInter.getResultQuery(99999999).enqueue(getQuery);


	}

}
