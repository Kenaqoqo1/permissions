<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use AfricasTalking\SDK\AfricasTalking;
use \Carbon\Carbon as Carbon;

class Token extends Model
{
 protected $table = 'tokens';
 const EXPIRATION_TIME = 5; // minutes
 protected $fillable = [
   'code',
   'user_id',
   'used'
 ];

 public function __construct(array $attributes = []){
   if (! isset($attributes['code'])) {
     $attributes['code'] = $this->generateCode();
   }

   parent::__construct($attributes);
 }

 public function generateCode($length = 5){
   $min = pow(10, $length);
   $max = $min * 10 - 1;
   $code = random_int($min, $max);

   return $code;
 }

 public function user(){
   return $this->belongsTo('App\User','user_id','id');
 }

 public function isTokenValid(){
   return !$this->isUsed() && !$this->isExpired();
 }

 public function isUsed(){
   return $this->used;
 }

 public function isExpired(){
   // $now = $this->created_at->diffInMinutes(Carbon::now());
   // return $now > static::EXPIRATION_TIME;
   return false;
 }

 public function sendCode(){
   if (is_null($this->user->phoneNumber)) {
     throw new \Exception("No user attached to this token.");
   }

   if (! $this->code) {
     $this->code = $this->generateCode();
   }

   $username = env('ATK_UNAME');
   $pwd = env('ATK_PWD');
   $atalking = new AfricasTalking($username,$pwd);
   $sms = $atalking->sms();
   // Use the service
   try{
     $phone = $this->user->getPhoneNumber();
     $message = 'Hi '.$this->user->name.' Your verification code is : '.$this->code;
     $result   = $sms->send([
       'to' => $this->user->getPhoneNumber(),
       'message' => 'Hi '.$this->user->name.' Your verification code is : '.$this->code
     ]);
     if($result['status'] == 'success'){
       return true;
     }else{
       dd($result);
     }
   }catch(\Exception $e){
     dd($e);
   }

 }
}
