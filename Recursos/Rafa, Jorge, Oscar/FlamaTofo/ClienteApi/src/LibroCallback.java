import com.google.gson.Gson;
import com.google.gson.JsonElement;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import okhttp3.Headers;

import java.io.IOException;
import java.util.ArrayList;
import java.util.List;


public class LibroCallback implements Callback<List<Libro>>{

	@Override
	public void onResponse(Call<List<Libro>> arg0, Response<List<Libro>> resp) {

		List<Libro> ret = null;
		ret = resp.body();

		System.out.println(resp.code());
		for (int i = 0; i<resp.body().size(); i++){


			System.out.println(ret.get(i).getTitulo());

		}

	}

	@Override
	public void onFailure(Call<List<Libro>> call, Throwable throwable) {

		ArrayList<Libro> pepe = new ArrayList<>();

		System.out.println(call.isExecuted());
		System.out.println(call.request().toString());
		System.out.println(throwable.getMessage());

	

	}


}
