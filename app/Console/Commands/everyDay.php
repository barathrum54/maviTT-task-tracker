<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \App\Musteri;
use Auth;
use \App\User;
class everyDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'everyDay:update';

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
     * @return mixed
     */
    public function handle()
    {
        $tumKullanicilar = User::all();
        $atanabilirMusterilerIndex = 0;
        $atanabilirMusteriler = \App\Musteri::where('durum','0')->get();
        $atanacakMusteriler = [];
        $atanacakMusterilerID = [];
        foreach ($tumKullanicilar as $key => $kullanici){
        User::where('id',$kullanici->id)->update(['aramalar' => null]);
        for ($i=0; $i <= 5; $i++) { array_push($atanacakMusteriler,$atanabilirMusteriler[$atanabilirMusterilerIndex]);
            $atanabilirMusterilerIndex ++; } foreach ($atanacakMusteriler as $key=> $musteri) {
            array_push($atanacakMusterilerID, $musteri->id);
            }
            User::where('id',$kullanici->id)->update(['aramalar' => $atanacakMusterilerID]);
            $atanacakMusterilerID = [];
            $atanacakMusteriler = [];
            };

    }
}