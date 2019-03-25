<?php
  namespace mainstreamct\SyncadConnectorLaravel;

  use App\User;
  use Illuminate\Http\Request;
  use Illuminate\Support\Facades\Auth;

  class SyncadConnector
  {
    /**
     * Multiplies the two given numbers
     * @param int $a
     * @param int $b
     * @return int
     */
    public function generateKey() {
      $key = str_random(60);
      return $key;
    }

    static function pokesLogin(Request $request) {
      $user = User::where('email', $request->email)->where('id', $request->id)->first();
      $data['key'] = $user->reKey();
      return $data;
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