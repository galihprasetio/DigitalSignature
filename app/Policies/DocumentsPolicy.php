<?php

namespace App\Policies;

use App\User;
use App\Documents;
use Illuminate\Auth\Access\HandlesAuthorization;

class DocumentsPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function show(User $user, Documents $document)
    {
         return $user->id === $document->doc_current_author;
    }
}
