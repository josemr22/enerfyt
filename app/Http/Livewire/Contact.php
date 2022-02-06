<?php

namespace App\Http\Livewire;

use App\Models\Message;
use Livewire\Component;

class Contact extends Component
{
    public $name,$email,$phone,$message,$type,$appointment_date;

    protected $rules = [
        'name'=>'required',
        'email'=>'required|email',
        'phone'=>'required|digits_between:6,13',
        'type'=>'required',
        'message'=>'required',
        'appointment_date'=>'nullable',
    ];

    protected $messages = [
        'name.required'=>'Ingrese su nombre',
        'email.required'=>'Ingrese su email',
        'email.email'=>'Ingrese un email válido',
        'phone.required'=>'Ingrese su teléfono',
        'phone.digits_between'=>'Ingrese un número teléfono válido',
        'type.required'=>'Ha ocurrido un error',
        'message.required'=>'Ingrese un mensaje',
        'appointment_date.required'=>'Ingrese una fecha para su cita',
    ];

    public function render()
    {
        return view('livewire.contact');
    }

    public function store(){
        if($this->type==='appointment'){
            $this->rules['appointment_date']='required';
            $msg = "Hola, soy $this->name, me gustaría una cita para el día $this->appointment_date. Mi correo es $this->email. $this->message";
        }else{
            $msg = "Hola, soy $this->name. Mi correo es $this->email. Estoy en tu página web y me gustaría decirte lo siguiente:  $this->message";
        }
        $data = $this->validate();
        Message::create($data);
        $this->name=null;
        $this->email=null;
        $this->phone=null;
        $this->message=null;
        // $this->type=null;
        $this->appointment_date=null;
        $this->emit('alertSuccess',['msg'=>$msg]);
    }
}
