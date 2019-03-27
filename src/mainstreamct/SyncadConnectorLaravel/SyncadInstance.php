<?php

  namespace mainstreamct\SyncadConnectorLaravel;

  use Illuminate\Database\Eloquent\Model;
  use App\User;

  class SyncadInstance extends Model
  {
    protected $fillable = ['syncad_key'];

    public function user() {
      return $this->belongsTo(User::class);
    }

    public function reKey() {
      $this->update(['syncad_key' => str_random(60)]);
      return $this->syncad_key;
    }
  }