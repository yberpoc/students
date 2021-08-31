<?php
class Auth
{
    private $ALogin;
    private $APassword;
    private $dataBase;

    public function __construct($ALogin, $APassword, $dataBase)
    {
        $this->ALogin = $ALogin;
        $this->APassword = $APassword;

        $this->dataBase = $dataBase;
    }

    public function auth()
    {
        $check_user = $this->dataBase->getQuery("SELECT * FROM `auth` WHERE `ALogin` = '$this->ALogin' AND `APassword` = '$this->APassword'");
        if (mysqli_num_rows($check_user) > 0) {
            $user = mysqli_fetch_assoc($check_user);
            $_SESSION['auth'] = ["AId" => $user['AId']];
            return true;
        } else {
            return false;
        }
    }
}