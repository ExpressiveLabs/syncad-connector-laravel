<?php
  namespace mainstreamct\SyncadConnectorLaravel;

  use App\User;
  use Illuminate\Support\Facades\Auth;
  use Illuminate\Support\Facades\Hash;

  class SyncadConnector
  {
    // Generates an access token
    static function generateKey() {
      $key = str_random(60);
      return $key;
    }

    // Creates a user
    static function makeUser($data) {
      $pass = str_random(20);

      $user = new User;
      $user->email = $data->email;
      $user->name = $data->name;
      $user->password = Hash::make($pass);
      $user->syncad_key = self::generateKey();
      $user->syncad_token = Hash::make($data->token);
      $user->type = 'admin';
      $user->save();

      return ['user' => $user, 'pass' => $pass];
    }

    static function pokesLogin($data) {
      $user = User::where('email', $data->email)->first();
      if(Hash::check($data->token, $user->token)) {
        $data['key'] = $user->reKey();
        return $data;
      }
    }

    static function authenticate($key, $return) {
      $user = User::where('syncad_key', $key)->first();
      if(Auth::loginUsingId($user->id)) {
        return redirect($return);
      }
    }

    static function validateKey($key) {
      return $key === config('syncad.key');
    }

    static function testConnection($key) {
      $status = self::validateKey($key);

      if($status) {
        $data['name'] = config('syncad.name');
        $data['color'] = config('syncad.color');
      }

      $data['status'] = $status;

      return $data;
    }
  }