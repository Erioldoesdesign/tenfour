<?php

namespace RollCall\Auth;

use Illuminate\Support\Str;
use Illuminate\Auth\EloquentUserProvider as IlluminateUserProvider;

class EloquentUserProvider extends IlluminateUserProvider
{
    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        if (empty($credentials)) {
            return;
        }

        // First we will add each credential element to the query as a where clause.
        // Then we can execute the query and, if we found a user, return it in a
        // Eloquent User "model" that will be utilized by the Guard instances.
        $query = $this->createModel()->newQuery();

        // Check username against all contacts
        $query->join('contacts', 'users.id', '=', 'contacts.user_id');
        if ($credentials['username']) {
            $credentials['contacts.contact'] = $credentials['username'];
            unset($credentials['username']);
        }

        foreach ($credentials as $key => $value) {
            if (! Str::contains($key, 'password')) {
                $query->where($key, $value);
            }
        }

        return $query->first();
    }
}
