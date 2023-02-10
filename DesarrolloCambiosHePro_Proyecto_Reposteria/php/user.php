<?php
include("./Conexion.php");
class User
{
    private $nombre;
    private $correo;
    private $connection;
    public function userExists($email)
    {
        $connection = new Conexion;
        $consultemail = $connection->OperSql("SELECT `Email` FROM `usuario` WHERE `Email`= '$email'");
        $email2 = mysqli_fetch_array($consultemail);
        $connection-> closeConnection();
        if ($email2 != null) {
            return true;
        }
        return false;
    }


    // public function setUser($user){
    //     $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE username = :user');
    //     $query->execute(['user' => $user]);

    //     foreach ($query as $currentUser) {
    //         $this->nombre = $currentUser['nombre'];
    //         $this->usename = $currentUser['username'];
    //     }
    // }

    // public function getNombre(){
    //     return $this->nombre;
    // }
}
