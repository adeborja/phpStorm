import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;



public class Llamada {

    private static String SERVER_URL = "http://biblioteca.devel:8080/";


    public static void main(String[] args) {
        // TODO Auto-generated method stub

        Retrofit retrofit;
        //Retrofit.Builder patata = new Retrofit.Builder();
        LibroCallback libroCallback = new LibroCallback();
        ListaLibroCallback listadoCallback = new ListaLibroCallback();
        VoidCallback voidCallback = new VoidCallback();

        Libro caca = new Libro("Caca","200");
        Libro utrera = new Libro("UtreraPutCliente","200");



        //retrofit = patata.baseUrl(SERVER_URL).addConverterFactory(GsonConverterFactory.create()).build();
        retrofit = new Retrofit.Builder().baseUrl(SERVER_URL).addConverterFactory(GsonConverterFactory.create()).build();

        LibroInterface libroInter = retrofit.create(LibroInterface.class);

        //libroInter.getLibro(2).enqueue(libroCallback);
        //libroInter.getLibros().enqueue(listadoCallback);
        //libroInter.deleteLibro(5).enqueue(voidCallback);
        //libroInter.deleteTodosLibros().enqueue(voidCallback);
        //libroInter.postLibro(caca).enqueue(voidCallback);
        //libroInter.putLibro(utrera, 5).enqueue(voidCallback);
        libroInter.getLibroParametros(100).enqueue(listadoCallback);

        //Genial tio
    }
}
