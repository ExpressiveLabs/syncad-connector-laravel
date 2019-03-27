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
      $user->save();

      $inst = new SyncadInstance;
      $inst->syncad_key = self::generateKey();
      $inst->syncad_token = Hash::make($data->token);
      $inst->type = 'admin';
      $inst->user_id = $user->id;
      $inst->save();

      return ['user' => $user, 'pass' => $pass];
    }

    static function pokesLogin($data) {
      $user = User::where('email', $data->email)->first();
      $inst = SyncadInstance::where('user_id', $user->id)->first();
      if(Hash::check($data->token, $inst->syncad_token)) {
        $data['key'] = $inst->reKey();
        return $data;
      }
    }

    static function authenticate($key, $return) {
      $inst = SyncadInstance::where('syncad_key', $key)->first();
      if(Auth::loginUsingId($inst->user_id)) {
        $inst->user()->first()->update(['syncad_key' => null]);
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