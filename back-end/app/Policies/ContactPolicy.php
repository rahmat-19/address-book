<?php

namespace App\Policies;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ContactPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Contact $contact)
    {
        return $user->id === $contact->user_id ? Response::allow()
        : Response::denyWithStatus(404, 'Contact not found');;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Contact $contact)
    {
        return $user->id === $contact->user_id ? Response::allow()
        : response()->json([
            "status" => false,
            "message" => "Forbiden",
           
        ], 404);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Contact $contact)
    {
        return $user->id === $contact->user_id ? Response::allow()
        : response()->json([
            "status" => false,
            "message" => "Forbiden",
           
        ], 404);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Contact $contact)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Contact $contact)
    {
        //
    }
}
