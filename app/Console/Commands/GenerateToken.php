<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class GenerateToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:token {--username=} {--password=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $userName = $this->option('username');
        $password = $this->option('password');
        if (!$userName || !$password) {
            $this->error("Username and Password required");
        }

        $user = User::where(['username' => $userName])->first();
        if (!$user) {
            $this->error("Wrong Username");
            return Command::FAILURE;
        }

        if (!Hash::check($password, $user->password)) {
            $this->error("Wrong Password");
            return Command::FAILURE;
        }

        $user->tokens()->delete();
        $token = $user->createToken('auth_token', ['*'], Carbon::now()->addMinutes(5));
        if (isset($token->accessToken) && !is_null($token->accessToken)) {
            $this->info("Token generated successfully");
            $this->info("Your token is: " . $token->accessToken->token);
            $this->info("Expires At: " . $token->accessToken->expires_at . ' ' . date_default_timezone_get());
            return Command::SUCCESS;
        }
        return Command::FAILURE;
    }
}
