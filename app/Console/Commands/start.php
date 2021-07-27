<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class start extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->call('migrate');

        User::create([
            'name'        => 'admin',
            'email'       => 'admin@admin',
            'password'    => Hash::make('admin'),
            'permissions' => 1,
        ]);

        User::create([
            'name'        => 'test',
            'email'       => 'test@test',
            'password'    => Hash::make('test'),
        ]);
        Category::create([
            'name' => 'Интервью',
            'slug' => Str::slug('Интервью'),
        ]);

    }
}
