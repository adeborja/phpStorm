<html>
<body>


Su nombre es: <?php echo $_POST["nombre"]; ?><br>
Su e-mail es: <?php echo $_POST["email"]; ?><br>
Su sexo es: <?php echo $_POST["sexo"];
                if ($_POST["sexo"] == "Otro"){

                    echo '<body style="background-color:grey">'; //Cambiar esto

                }
                ?><br>
Licencia: <?php echo $_POST["licencia"]; ?>

</body>
</html>