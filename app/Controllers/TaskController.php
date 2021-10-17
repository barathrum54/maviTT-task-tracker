<?php

namespace App\Http\Controllers;
use \App\Task;
use \App\Kategori;
use \App\Pano;
use \App\User;
use Auth;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        Task::where([
        ['atanan_id',auth()->id()],
        ['goruldu',0]])->update(['goruldu' => 1]);
        $tasks = Task::where('AKTIF', $request->query('AKTIF',1))->orderBy('updated_at', 'DESC')->paginate(5);
        $users = \App\User::all();
        return view('tasks.index', compact('tasks','users'));
    }
    public function create()
    {
        $kategoriler = Kategori::all();
        $task = new Task();
        $users = \App\User::all();
        return view('tasks.create', compact('task','users','kategoriler'));
    }
    public function store(Request $request)
    {
        $task = Task::create($this->validatedData());
        $task->atayan_id = auth()->id();
        $task->update();
        return redirect('/tasks');
    }
    public function show(\App\Task $task)
    {
        return view('tasks.show', compact('task'));
    }
    public function edit(\App\Task $task)
    {
        return view('tasks.edit', compact('task'));
    }
    public function update(\App\Task $task)
    {
        $task->update($this->validatedData());

        return redirect('/tasks');
    }

    public function destroy(\App\Task $task){

        $task->delete();

        return redirect('/tasks');
    }
    public function tamamla(\App\Task $task)
    {
        
        $task->AKTIF = 0;
        if($task->hedefSure != null){
            if($task->hedefSure < now()){
                $task->SURESI_ASILMIS = 1;
            }
        }
        $task->update();
          $user = Auth::User()->name;

      $pano = new Pano;
      $pano->cumle =
      '<strong style="color:#8686ff;">'. $user . '</strong>'. ' ' . 'yeni bir görev bitirdi: ' .
      ' ' .
      '<strong style="color:#46d846">'. $task->BASLIK .'</strong>';
      $pano->yetki = 1;
      $pano->save();
        return redirect('/tasks');
    }
      public function hizliTamamla(\App\Task $task)
      {

      $task->AKTIF = 0;
      if($task->hedefSure != null){
      if($task->hedefSure < now()){ $task->SURESI_ASILMIS = 1;
          }
          }
          $task->update();

          $user = Auth::User()->name;
          $pano = new Pano;
          $pano->cumle = 
          '<strong>'. $user . '</strong>'. ' ' . 'yeni bir görev bitirdi: ' .
           ' ' .
          '<strong>'. $task->BASLIK .'</strong>';
          $pano->yetki = 1;
          $pano->save();
          return redirect('/');
          }
    public function iptal(\App\Task $task)
    {

    $task->AKTIF = 2;
    $task->update();

    return redirect('/tasks');
    }
    protected function validatedData()
    {
    

      return request()->validate([
            'ACIKLAMA'=>'required',
            'BASLIK'=>'required',
            'KATEGORI_ID'=>'required',
            'ATANAN_ID'=>'required',
            'NOTLAR'=>'',
            'hedefSure'=>'',
        ]);
    }
  
}