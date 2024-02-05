<?php 

if($peticionAjax){
    require_once "../config/SERVER.php";
    
}else{
    require_once "./config/SERVER.php";
     

}

class MainModel{
    protected static function conectar(){
        $conexion=new PDO(SGBD,USER,PASS); 
        $conexion->exec("SET CHARACTER SET utf8");
        return $conexion;

 }




 protected static function conectar_oracle(){
     $conexion_oracle=oci_connect('cvida', 'cvida2015','10.238.84.3/BASDAT','AL32UTF8');
     return  $conexion_oracle;

 }




 protected static function execute_sentence_simple($consulta){
     $sql=self::conectar()->prepare($consulta);
     $sql->execute();
     return $sql;
 }


 public function encryption($string){
     $output=FALSE;
     $key=hash('sha256', SECRET_KEY);
     $iv=substr(hash('sha256', SECRET_IV), 0, 16);
     $output=openssl_encrypt($string, METHOD, $key, 0, $iv);
     $output=base64_encode($output);
     return $output;
 }

 protected static function decryption($string){
     $key=hash('sha256', SECRET_KEY);
     $iv=substr(hash('sha256', SECRET_IV), 0, 16);
     $output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
     return $output;
 }


 protected static function generate_cod_random(){
    $random2 = 0;
     for($i=1;$i<=6;$i++){
         $random=rand(0,9);
         $random2 .= $random;
     }

     
     return $random2;
 }



 protected static function clean_string($string){
     $string=str_ireplace("<script>","",$string);
     $string=str_ireplace("</script>","",$string);
     $string=str_ireplace("<script src","",$string);
     $string=str_ireplace("<script type=","",$string);
     $string=str_ireplace("SELECT * FROM","",$string);
     $string=str_ireplace("DELETE * FROM","",$string);
     $string=str_ireplace("INSERT INTO","",$string);
     $string=str_ireplace("DROP TABLE","",$string);
     $string=str_ireplace("DROP DATABASE","",$string);
     $string=str_ireplace("TRUNCATE TABLE","",$string);
     $string=str_ireplace("SHOW TABLES","",$string);
     $string=str_ireplace("SHOW DATABASES","",$string);
     $string=str_ireplace("<?php","",$string);
     $string=str_ireplace("?>","",$string);
     $string=str_ireplace("--","",$string);
     $string=str_ireplace(">","",$string);
     $string=str_ireplace("<","",$string);
     $string=str_ireplace("[","",$string);
     $string=str_ireplace("]","",$string);
     $string=str_ireplace("^","",$string);
     $string=str_ireplace("==","",$string);
     $string=str_ireplace("::","",$string);
     $string =trim($string);
     $string=stripslashes($string);
    return $string;
 }
}