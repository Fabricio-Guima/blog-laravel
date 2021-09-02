<?php

namespace App\Observers;

use App\Models\Client;
use Illuminate\Support\Str;

class ClientObserver
{
    /**
     * Handle the client "creating" event.
     *
     * @param  \App\Models\Table  $table
     * @return void
     */
    public function creating(Client $client)
    {
        $client->uuid = Str::uuid();
    }
}