<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;
use common\models\Profile;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $firstname;
    public $lastname;
    public $middlename;
    public $birthdate;
    public $country_id;
    public $region_id;
    public $city_id;
    public $gender;
    public $phone;
    public $address;
    public $hobby;
    public $education_type;
    public $education_info;
    public $marriage_status;
    public $has_children;
    public $skype;
    public $website;
    public $workplace;
    public $religion;



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            [['firstname','lastname','middlename', 'country_id', 'region_id', 'city_id'],'required'],
            [['phone','address','hobby','education_info','skype','website','marriage_status', 'workplace'], 'string'],
             [['gender', 'education_type','country_id', 'region_id', 'city_id', 'has_children', 'religion'],'integer'],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        $user->save();


        $profile = new Profile();
        $profile->user_id = $user->id;
        $profile->firstname = $this->firstname;
        $profile->lastname = $this->lastname;
        $profile->middlename = $this->middlename;
        $profile->birthdate = $this->birthdate;
        $profile->country_id = $this->country_id;
        $profile->region_id = $this->region_id;
        $profile->city_id = $this->city_id;
        $profile->gender = $this->gender;
        $profile->phone = $this->phone;
        $profile->address = $this->address;
        $profile->hobby = $this->hobby;
        $profile->education_type = $this->education_type;
        $profile->education_info = $this->education_info;
        $profile->marriage_status = $this->marriage_status;
        $profile->has_children = $this->has_children;
        $profile->skype = $this->skype;
        $profile->website = $this->website;
        $profile->workplace = $this->workplace;
        $profile->religion = $this->religion;

        if($profile->save(false)){
            return $user;
        }else{
            $user->delete();
            return null;
        }

    }
}
