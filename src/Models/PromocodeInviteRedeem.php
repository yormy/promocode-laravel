<?php

namespace Yormy\PromocodeLaravel\Models;

use Yormy\Xid\Models\Traits\Xid;

class PromocodeInviteRedeem extends BaseModel
{
    use Xid;

    protected $table = 'promocodes_invites_redeem';


    protected $fillable = [
        'user_id',
        'user_type',
        'promocode_invite_id'
    ];
}
