<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    protected $AdminController;
    public function index()
    {

        $userid = Auth::user()['id'];
        $role = Auth::user()['role'];
        $users = User::count();
        $classes = DB::table('userclassbatch')->where('userclassbatch.user_id','=', $userid)->join('batchclass', 'userclassbatch.batchclass_id', '=', 'batchclass.id')->where('batchclass.is_active','>',0)->join('class', 'class.id', '=', 'batchclass.class_id')->join('batch','batch.id','=','batchclass.batch_id')->get();
        //dd($classes);
        $widget = [
            'users' => $users,
            'classes' => $classes
        ];
        //dd($classes);
        // role 1 adalah siswa
        // role 0 adalah admin pendidikan
        // role 2 adalah admin gembong
        if($role == 1){
            return view('home', compact('widget'));
        }elseif($role == 0){
            return redirect()->route('admin');
        }elseif($role == 2){
            return view('home', compact('widget'));
        }
    }

    public function detail($id){
        //dd($id);
        $userid = Auth::user()['id'];
        $class = DB::table('class')->where('class.id','=',$id)->join('batchclass','batchclass.class_id','=','class.id')->join('batch','batch_id','=','batchclass.batch_id')->select('class.*','batch.*','batchclass.*')->first();
        $assignment = DB::table('assignment')->where('assignment.batchkelas_id','=',$class->id)->get();
        $answer = DB::table('userassignment')->where('userassignment.user_id','=',$userid)->join('assignment','assignment.id','=','userassignment.assignment_id')->get();
        $materi = DB::table('materi')->where('materi.materi_batchclass_id','=',$class->id)->get();
        //dd($materi);
        for($i=0;$i<count($assignment);$i++){
            $assignmentid[$i] = $assignment[$i]->id;
        }
        for($i=0;$i<count($answer);$i++){
            $useranswerid[$i] = $answer[$i]->assignment_id;
        }

        $availableassignmentid = array_values(array_diff($assignmentid,$useranswerid));
        if(count($availableassignmentid) > 0){
            $x=0;
            for($i=0;$i<count($assignment);$i++){
                if(in_array($assignment[$i]->id,$availableassignmentid)){
                    $unfinishedassignment[$x] = $assignment[$i];
                    $x++;
                }
            }
        }else{
            $unfinishedassignment = null;
        }

        //dd($unfinishedassignment);
        $data = [
            'assignment' => $unfinishedassignment,
            'class' => $class,
            'answer' => $answer,
            'materi' => $materi
        ];
        return view('detail', compact('data'));
    }

    public function jawaban(Request $request){
        $now = Carbon::now();
        $userid = Auth::user()['id'];
        //dd($request);
        DB::table('userassignment')->insert(array(
            'user_id' => $userid,
            'assignment_id' => $request->listtugas,
            'linkjawaban' => $request->linkjawaban,
            'created_at' => $now,
            'updated_at' => $now
        ));
        return redirect()->route('detail',[$request->batchclass]);
    }

    public function kelastersedia(){
        //dd($id);
        $now = Carbon::now()->format('Y-m-d');
        $classes = DB::table('batch')->where('batch.batch_start_date','>',$now)->where('batch.delete_status','=',0)->join('batchclass','batch.id','=','batchclass.batch_id')->where('batchclass.is_active','=',2)->join('class','class.id','=','batchclass.class_id')->select('batch.*','class.*','batchclass.*')->get();
        //dd($classes);
        return view('kelasbaru', compact('classes'));
    }

    public function siswakelasbaru($id){
        $userid = Auth::user()['id'];
        DB::table('userclassbatch')->insert(array(
            'user_id' => $userid,
            'batchclass_id' => $id,
            'is_paid' => 0
        ));
        return redirect()->route('home');
    }
}
