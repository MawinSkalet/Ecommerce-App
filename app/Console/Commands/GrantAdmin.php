<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class GrantAdmin extends Command
{
    protected $signature = 'user:grant-admin {email : The email of the user to grant admin role}';

    protected $description = 'Grant admin role to a user by email';

    public function handle(): int
    {
        $email = $this->argument('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User with email [{$email}] not found.");
            return 1;
        }

        if ($user->role === 'admin') {
            $this->warn("{$user->name} ({$user->email}) is already an admin.");
            return 0;
        }

        $user->role = 'admin';
        $user->save();

        $this->info("Admin role granted to {$user->name} ({$user->email}).");
        return 0;
    }
}
