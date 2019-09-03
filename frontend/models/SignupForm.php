<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_repeat;
    public $nombre;
    public $apellidos;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            [['username','nombre','apellidos'], 'required','message'=>'Este campo no puede estar en blanco.'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            [['username','nombre','apellidos'], 'string', 'min' => 2, 'max' => 255],
            
            [['username'], 'match', 'pattern' => '/^[a-z áéíóúñçÁÉÍÓÚÑÇ0]+$/i','message'=>'Solo letras'],
            [['nombre'], 'match', 'pattern' => '/^[a-z áéíóúñçÁÉÍÓÚÑÇ0]+$/i','message'=>'Solo letras'],
            [['apellidos'], 'match', 'pattern' => '/^[a-z áéíóúñçÁÉÍÓÚÑÇ0]+$/i','message'=>'Solo letras'],
            

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required','message'=>'Este campo no puede estar en blanco.'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            
            ['password', 'string', 'min' => 6],
            ['password', 'compare', 'operator' => '==','message'=>'Las contraseñas deben coincidir.'],
            ['password_repeat', 'required','message'=>'Este campo no puede estar en blanco.'],
            ['password_repeat', 'string', 'min' => 6],
            ['password', 'required','message'=>'Este campo no puede estar en blanco.'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            
            'username' => 'Usuario',
            'email' => 'Correo',
            'password_repeat' => 'Contraseña',
            'password' => 'Confirmar Contraseña',
        ];
    }
    
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->nombre=  $this->nombre;
            $user->apellidos=  $this->apellidos;
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
          }

        return null;
    }
    
    
    public function updateuser($id)
    {
        $user = User::findIdentity($id);
        
        if ($this->validate()) {
            //$user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->nombre =  $this->nombre;
            $user->apellidos =  $this->apellidos;
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
          }

        return null;
    }
}
