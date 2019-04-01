import okhttp3.Headers;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;


public class DeleteLibroCallback implements Callback<Void>{

	@Override
	public void onFailure(Call<Void> arg0, Throwable arg1) {
		// TODO Auto-generated method stub
		int i;
		
		i=0;
		
		
		
	}

    //recibe una coleccion de libros
    //NO SE PUEDE TENER DOS METODOS OnResponse
    //SERÁ NECESARIO IMPLEMENTAR TOODO SOLO EN UNO
    //O BIEN CREAR OTRO CALLBACK
	@Override
	public void onResponse(Call<Void> arg0, Response<Void> resp) {
		// TODO Auto-generated method stub
		
	/*Libro libro;
	//List<Libro> list;
	String contentType;
	String message;
	boolean isSuccesful;*/

	int code;
	
	//list = resp.body();
	//libro = resp.body();

	Headers cabeceras = resp.headers();
	/*contentType = cabeceras.get("Content-Type");

	message = resp.message();
	isSuccesful = resp.isSuccessful();*/

	code = resp.code();
	
	//System.out.println("Solo libro: "+libro.getCodigo()+" "+libro.getTitulo()+" "+libro.getNumpag());
	System.out.println("delete hecho");
	System.out.println(code);


	}


}
