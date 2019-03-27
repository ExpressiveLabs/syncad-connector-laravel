<?php

  namespace mainstreamct\SyncadConnectorLaravel;

  use Illuminate\Database\Eloquent\Model;

  class SyncadInstance extends Model
  {
    public function user() {
      return $this->belongsTo(User::class);
    }

    public function reKey() {
      $this->update(['syncad_key' => str_random(60)]);
      return $this->syncad_key;
    }
  }