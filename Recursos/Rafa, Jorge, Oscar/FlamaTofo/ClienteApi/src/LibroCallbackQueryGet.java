import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

import java.util.List;

public class LibroCallbackQueryGet  implements Callback<List<Libro>> {


    @Override
    public void onResponse(Call<List<Libro>> call, Response<List<Libro>> response) {

        List<Libro> ret = null;
        ret = response.body();

        System.out.println(response.code());
        for (int i = 0; i<response.body().size(); i++){

            System.out.println(ret.get(i).getTitulo() + ret.get(i).getNumpag());

        }

    }

    @Override
    public void onFailure(Call<List<Libro>> call, Throwable throwable) {

        System.out.println("Esto no funca");

    }

}
