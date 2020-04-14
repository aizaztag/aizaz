<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{

    // override the id primary key

    protected $primaryKey = 'tweet_id';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tweets';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    public function user()
    {
        return $this->belongsTo('App\User', 'twitter_id', 'twitter_id');
    }

}
