<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Stores an admin in a database ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (User::where('email', 'tyumin000@gmail.com')->get()->count() > 0) {
            $this->info('Admin has already been created');
            return ;
        }

        User::create([
            'first_name' => 'Admin',
            'last_name' => 'Userowec',
            'phone_number' => '9999999999',
            'email' => 'tyumin000@gmail.com',
            'password' => Hash::make('12345678')
        ]);
        $this->info('Admin created successfully');
    }
}
