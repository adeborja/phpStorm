import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

import java.util.List;


public class ListaLibroCallback implements Callback<List<Libro>> {

    @Override
    public void onFailure(Call<List<Libro>> arg0, Throwable arg1) {
        // TODO Auto-generated method stub
        int i;

        i = 0;

        System.out.println(i);

        //Mi propia existencia, y la de PHP


    }

    @Override
    public void onResponse(Call<List<Libro>> arg0, Response<List<Libro>> resp) {
        // TODO Auto-generated method stub

        System.out.println(resp.code() + " " + resp.message());
        
        for (int i = 0; i < resp.body().size(); i++){


            System.out.println(resp.body().get(i).getTitulo()+" "+resp.body().get(i).getNumpag()+" "+resp.body().get(i).getCodigo());

        }


    }





}
