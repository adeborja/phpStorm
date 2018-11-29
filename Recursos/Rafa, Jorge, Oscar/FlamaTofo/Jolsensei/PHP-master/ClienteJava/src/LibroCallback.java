import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

import java.util.ArrayList;


public class LibroCallback implements Callback<Libro> {

    @Override
    public void onFailure(Call<Libro> arg0, Throwable arg1) {
        // TODO Auto-generated method stub
        int i;

        i = 0;

        System.out.println(i);

        //Mi propia existencia, y la de PHP


    }

    @Override
    public void onResponse(Call<Libro> arg0, Response<Libro> resp) {
        // TODO Auto-generated method stub


        System.out.println(resp.code() + " " + resp.message());
        System.out.println(resp.body().getTitulo()+" "+resp.body().getNumpag()+" "+resp.body().getCodigo());


    }





}
