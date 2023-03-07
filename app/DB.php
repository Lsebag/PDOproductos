<?php

class DB
{
    private $conexion;

    public function __construct()
    {
        try {
            $this->conexion = new PDO(DSN, USER, PASS);
        }catch (PDOException $exception){
            die("No se ha podido conectar " . $exception->getMessage());
        }}

    /*    public function valida_usuario($nombre,$pass){
            //Aquí creo la sentencia usando parámetros
            $consulta = <<<FIN
                    select *
                    from usuarios
                    where nombre = :nombre
                        and
                         pass=:pass
                    FIN;

            //al principio usábamos lo siguiente, pero está mal porque no debemos pasar directamente las variables en
            //la consulta.
            // $consulta="select * from usuarios where nombre='$nombre' and pass='$pass'";

            //Aquí está la consulta usando parámetros
            $consulta="select * from usuarios where nombre=:nombre and pass=:pass";
            // $consulta="select * from usuarios where nombre=? and pass=?";

            //Aquí creo la consulta preparada (PDOStatement)
            $rtdo=$this->conexion->prepare($consulta);

            //Ligo o establezco los valores a cada uno de los parámetros
            $rtdo->bindParam(':nombre',$nombre);
            $rtdo->bindParam(':pass',$pass);

            //Si hubiera parametrizado con las interrogaciones debo ligar o establecer así:
            //$rtdo->bindParam(1,$nombre);
            //$rtdo->bindParam(2,$pass);

            //Ejecuto la sentencia
            $rtdo->execute();

            //También puedo hacer así:

            //Ahora no utlizaremos esta línea que recoge porque la variable $rtdo ya es un PDOStatement al hacer el execute
            //$rtdo= $this->conexion->query($consulta);

            if($rtdo->rowCount()>0)
                return true;
            else
                return false;
        }*/

    //Otra forma de resolverlo:
    public function valida_usuario($nombre, $pass)
    {
        $consulta = "select * from usuarios where nombre = ? and pass=?  ";
        $rtdo = $this->ejecuta_consulta($consulta,[$nombre, $pass]);

        if($rtdo->rowCount()>0)
            return true;
        else
            return false;
    }

    private function ejecuta_consulta(string $sentencia, array $valores=[]): PDOStatement{
        //Creo la consulta preparada (PDOStatement)
        $rtdo = $this->conexion->prepare($sentencia);

        //Ligo o establezco los valores a cada uno de los parámetros
//        $rtdo->bindParam(1, $nombre);
//        $rtdo->bindParam(2, $pass);
        //ejecuta la sentencia

        $rtdo->execute($valores);
        return $rtdo;
    }

    public function dime_categorias():PDOStatement{
        $sentencia ="select * from familia";
        return $this->ejecuta_consulta($sentencia);
        //$rtdo= $this->conexion->query($sentencia);
        //return $rtdo;
    }

    public function dime_productos():PDOStatement{
        $sentencia ="select nombre_corto,familia,cod,PVP,descripcion from producto";
        return $this->ejecuta_consulta($sentencia);
        //$rtdo= $this->conexion->query($sentencia);
        //return $rtdo;
    }


}