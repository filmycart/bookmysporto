<?php

class Contact extends Util{

    public $id;
    public $name;
    public $email;
    public $mobile;
    public $message;
    public $status = 0;

    public function save(){
        return parent::save();
    }

    public function Update($not_empty_field = []){
        return parent::Update();
    }

    public function response(){
        $new_contact = new Contact();
        $new_contact->id = $this->id;
        $new_contact->name = $this->name;
        $new_contact->email = $this->email;
        $new_contact->mobile = $this->mobile;
        $new_contact->message = $this->message;
        return $new_contact;
    }

}