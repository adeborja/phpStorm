import okhttp3.Headers;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

import java.util.List;


public class ListaLibroCallback implements Callback<List<Libro>>{

	@Override
	public void onFailure(Call<List<Libro>> arg0, Throwable arg1) {
		// TODO Auto-generated method stub
		int i;
		
		i=0;
		
		
		
	}

	@Override
	public void onResponse(Call<List<Libro>> arg0, Response<List<Libro>> resp) {
		// TODO Auto-generated method stub
		
	//Libro libro;
	List<Libro> list;
	String contentType;
	int code;
	String message;
	boolean isSuccesful;
	
	list = resp.body();
	//libro = list.get(0);

	Headers cabeceras = resp.headers();
	contentType = cabeceras.get("Content-Type");
	code = resp.code();
	message = resp.message();
	isSuccesful = resp.isSuccessful();


	if(isSuccesful)
	{
		for(Libro libro:list)
		{
			System.out.println(libro.getCodigo()+" "+libro.getTitulo()+" "+libro.getNumpag());
		}
	}
	else
	{
		System.out.println(code+" "+message);
	}





	}


}
