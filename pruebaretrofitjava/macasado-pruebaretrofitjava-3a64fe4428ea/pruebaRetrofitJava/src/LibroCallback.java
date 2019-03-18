package pruebaRetrofitJava;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import okhttp3.Headers;


public class LibroCallback implements Callback<Libro>{

	@Override
	public void onFailure(Call<Libro> arg0, Throwable arg1) {
		// TODO Auto-generated method stub
		int i;
		
		i=0;
		
		
		
	}

	@Override
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

    

		
	}

	@Override
	public void onResponse(Call<List<Libro>> arg0, Response<Libro> resp) {
		// TODO Auto-generated method stub

		Libro[] libros;
		String contentType;
		int code;
		String message;
		boolean isSuccesful;

		libros = resp.body();

		Headers cabeceras = resp.headers();
		contentType = cabeceras.get("Content-Type");
		code = resp.code();
		message = resp.message();
		isSuccesful = resp.isSuccessful();

		for(int i=0;i<libros.length;i++)
		{
			System.out.println(libro[i].getId()+" "+libro[i].getTitulo()+" "+libro[i].getNumpag());
		}

	}
	

}
