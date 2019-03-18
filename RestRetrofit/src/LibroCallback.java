import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import okhttp3.Headers;

import java.util.List;


public class LibroCallback implements Callback<Libro>{

	@Override
	public void onFailure(Call<Libro> arg0, Throwable arg1) {
		// TODO Auto-generated method stub
		int i;
		
		i=0;
		
		
		
	}

    //recibe una coleccion de libros
    //NO SE PUEDE TENER DOS METODOS OnResponse
    //SERÁ NECESARIO IMPLEMENTAR TOODO SOLO EN UNO
    //O BIEN CREAR OTRO CALLBACK
	@Override
	public void onResponse(Call<Libro> arg0, Response<Libro> resp) {
		// TODO Auto-generated method stub
		
	Libro libro;
	//List<Libro> list;
	String contentType;
	int code;
	String message;
	boolean isSuccesful;
	
	//list = resp.body();
	libro = resp.body();

	Headers cabeceras = resp.headers();
	contentType = cabeceras.get("Content-Type");
	code = resp.code();
	message = resp.message();
	isSuccesful = resp.isSuccessful();
	
	System.out.println("Solo libro: "+libro.getCodigo()+" "+libro.getTitulo()+" "+libro.getNumpag());




	}


    //recibe un libro
    /*@Override
    public void onResponse(Call<Libro> arg0, Response<Libro> resp) {
        // TODO Auto-generated method stub

        Libro libro;
        String contentType;
        int code;
        String message;
        boolean isSuccesful;

        libro = resp.body();

        Headers cabeceras = resp.headers();
        contentType = cabeceras.get("Content-Type");
        code = resp.code();
        message = resp.message();
        isSuccesful = resp.isSuccessful();

        System.out.println(libro.getId()+" "+libro.getTitulo()+" "+libro.getNumpag());




    }*/


}
