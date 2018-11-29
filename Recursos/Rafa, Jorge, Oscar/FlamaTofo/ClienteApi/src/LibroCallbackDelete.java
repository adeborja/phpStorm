import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;




public class LibroCallbackDelete  implements Callback<Void> {

    @Override
    public void onResponse(Call<Void> call, Response<Void> response) {

        System.out.print(response.code());

    }

    @Override
    public void onFailure(Call<Void> call, Throwable throwable) {

    }
}
