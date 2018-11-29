import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

import java.util.List;


public class VoidCallback implements Callback<Void> {

    @Override
    public void onFailure(Call<Void> arg0, Throwable arg1) {
        // TODO Auto-generated method stub
        int i;

        i = 0;

        System.out.println(i);

        //Mi propia existencia, y la de PHP


    }

    @Override
    public void onResponse(Call<Void> arg0, Response<Void> resp) {
        // TODO Auto-generated method stub


        System.out.println(resp.code() + " " + resp.message());
        


    }





}
