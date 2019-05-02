import okhttp3.Headers;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;


public class PostUsuarioCallback implements Callback<Void>{

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
		
	Usuario usuario;
	String contentType;
	int code;
	String message;
	boolean isSuccesful;

	Headers cabeceras = resp.headers();
	contentType = cabeceras.get("Content-Type");
	code = resp.code();
	message = resp.message();
	isSuccesful = resp.isSuccessful();
	
	System.out.println("post usuario hecho");
	System.out.println(resp.code());


	}


}
