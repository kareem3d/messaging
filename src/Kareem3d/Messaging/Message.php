<?php namespace Kareem3d\Messaging;

use Illuminate\Support\Facades\App;
use Kareem3d\Eloquent\Model;
use Kareem3d\Membership\User;

class Message extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'messages';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array();

    /**
     * The attributes that can't be mass assigned
     *
     * @var array
     */
    protected $guarded = array('id');

    /**
     * Whether or not to softDelete
     *
     * @var bool
     */
    protected $softDelete = false;

    /**
     * Validations rules
     *
     * @var array
     */
    protected $rules = array(
    );

    /**
     * For factoryMuff package to be able to fill attributes.
     *
     * @var array
     */
    public static $factory = array(
    );

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return User
     */
    public function getFromUser()
    {
        return App::make('Kareem3d\Membership\User')->getByCreation($this)->first();
    }

    /**
     * @return User
     */
    public function getToUser()
    {
        return App::make('Kareem3d\Membership\User')->getByRecipient($this)->first();
    }

    /**
     * @param User $user
     * @return \Illuminate\Support\Collection
     */
    public static function inbox( User $user )
    {
        return $user->getRecipients(static::getClass());
    }

    /**
     * @param User $user
     * @return \Illuminate\Support\Collection
     */
    public static function sent( User $user )
    {
        return $user->getCreations(static::getClass());
    }
}