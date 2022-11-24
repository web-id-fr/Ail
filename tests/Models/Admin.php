<?php

namespace Webid\Ail\Tests\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use Webid\Ail\Interfaces\ImpersonateInterface;

class Admin extends Authenticatable implements ImpersonateInterface
{
    use HasFactory;
    use Notifiable;
    use Impersonate;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getImpersonateName(): string
    {
        return $this->name;
    }

    public function getImpersonateAttributeToSearch(): string
    {
        return 'name';
    }
}
