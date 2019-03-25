<?php
  namespace mainstreamct\SyncadConnectorLaravel;

  use App\User;

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

    public function pokesLogin(Request $request) {
      $user = User::where('email', $request->email)->where('id', $request->id)->first();
      $data['key'] = $user->reKey();
      return $data;
    }

    public function authenticate(Request $request) {
      $user = User::where('syncad_key', $request->key)->first();
      if(Auth::loginUsingId($user->id)) {
        return redirect('/admin');
      }
    }

    private function validateKey($key) {
      return $key === config('app.syncad.key');
    }

    public function testConnection($key) {
      $data['status'] = $this->validateKey($key);
      $data['name'] = 'inHouse';
      $data['color'] = '#ff991e';

      return $data;
    }
  }