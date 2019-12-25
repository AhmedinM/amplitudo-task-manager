<?php

interface ICanResetPassword{
    function resetPassword();
}

interface ICanResetEmail{
    function resetEmail();
}

trait CanResetPassword{
    public function resetPassword(){

    }
}

trait CanResetEmail{
    public function resetEmail(){
        
    }
}
//trait - jedan objekat nasljedjuje vise klasa

class User /*implements ICanResetPassword, ICanResetEmail*/{
    //public function resetPassword(){}

    //public function resetEmail(){}

    use CanResetPassword;
    use CanResetEmail;

    public function foo(){
        $this->resetPassword();
    }
}