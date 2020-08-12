<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $now = Carbon::now()->format('Y-m-d');
        $userid = Auth::user()['id'];
        $role = Auth::user()['role'];
        $classes = DB::table('batch')->where('batch_start_date','<=',$now)->where('batch_end_date','>=',$now)->join('batchclass','batchclass.batch_id','=','batch.id')->where('batchclass.is_active','>', 0)->join('class', 'batchclass.class_id', '=', 'class.id')->select('class.*','batch.*','batchclass.*')->get();

        //$classes = DB::table('batchclass')->where('batchclass.is_active','=', 1)->join('class', 'userclass.class_id', '=', 'class.id')->select('userclass.*', 'class.*')->get();
        $widget = [
            'classes' => $classes,
            'now' => $now
        ];
        //dd($classes);
        // role 1 adalah siswa
        // role 0 adalah admin pendidikan
        // role 2 adalah admin gembong
        if($role == 1){
            return view('home', compact('widget'));
        }elseif($role == 0){
            return view('adminhome', compact('widget'));
        }elseif($role == 2){
            return view('home', compact('widget'));
        }
    }

    public function siswa(){
        $role = Auth::user()['role'];
        if($role == 0){
            $siswa = DB::table('users')->where('role','=',1)->get();
            //dd($siswa);
            return view('adminsiswa',  compact('siswa'));
        }else{
            return redirect()->route('home');
        }

    }

    public function kelas(){
        $role = Auth::user()['role'];
        if($role == 0){
            $classes = DB::table('class')->get();
            return view('adminkelas',  compact('classes'));
        }else{
            return redirect()->route('home');
        }
    }

    public function savekelas(Request $request){
        $now = Carbon::now();
        //dd($request);
        DB::table('class')->insert(array(
            'classname' => $request->name,
            'classdescription' => $request->description,
            'classlevel' => $request->level,
            'class_delete_status' => 0,
            'imagecover' => 'imagecovername',
            'created_at' => $now,
            'updated_at' => $now
        ));
        return redirect()->route('kelas');
    }

    public function tugas(Request $request){
        $now = Carbon::now();
        //dd($request);
        DB::table('assignment')->insert(array(
            'judulassignment' => $request->judulassignment,
            'deskripsiassignment' => $request->deskripsiassignment,
            'batchkelas_id' => $request->batchclass,
            'created_at' => $now,
            'updated_at' => $now
        ));
        return redirect()->route('detailkelas',[$request->batchclass]);
    }

    public function materi(Request $request){
        $now = Carbon::now();
        //dd($request);
        DB::table('materi')->insert(array(
            'namamateri' => $request->namamateri,
            'deskripsimateri' => $request->deskripsimateri,
            'materi_batchclass_id' => $request->batchclass,
            'linkmateri' => $request->linkmateri,
            'created_at' => $now,
            'updated_at' => $now
        ));
        return redirect()->route('detailkelas',[$request->batchclass]);
    }

    public function batch(){
        $role = Auth::user()['role'];
        if($role == 0){
            $classes = DB::table('class')->get();
            $batches = DB::table('batch')->get();
            $data = [
                'batches' => $batches,
                'classes' => $classes
            ];
            return view('adminbatch',  compact('data'));
        }else{
            return redirect()->route('home');
        }
    }

    public function savebatch(Request $request){
        $now = Carbon::now();
        //dd($request->kelas);
        $start = date('Y-m-d',strtotime($request->start));
        $end = date('Y-m-d',strtotime($request->end));
        //dd($newformat);
        DB::table('batch')->insert(array(
            'batchname' => $request->name,
            'batchdescription' => $request->description,
            'batch_start_date' => $start,
            'batch_end_date' => $end,
            'delete_status' => 0,
            'created_at' => $now,
            'updated_at' => $now
        ));
        $datenow = Carbon::now()->format('Y-m-d');
        $class = DB::table('class')->get('id');
        $batch = DB::table('batch')->orderByDesc('id')->first('id');
        //dd($batch);
        //dd($class[0]->id);
        $is_active = 0;
        for($i=0;$i<count($class);$i++){
            if(in_array($class[$i]->id, $request->kelas)){
                if($datenow < $start){
                    $is_active = 2;
                }else{
                    $is_active = 1;
                }
            }else{
                $is_active = 0;
            }
            DB::table('batchclass')->insert(array(
                'batch_id' => $batch->id,
                'class_id' => $class[$i]->id,
                'is_active' => $is_active
            ));
        }
        return redirect()->route('batch');
    }

    public function pembayaran(){
        $now = Carbon::now()->format('Y-m-d');
        //$currentbatch = DB::table('batch')->where('start_date','<=',$now)->where('end_date','>=',$now)->get();

        $siswa = DB::table('userclassbatch')->join('batchclass','batchclass.id','=','userclassbatch.batchclass_id')->where('batchclass.is_active','>',0)->join('users','users.id','=','userclassbatch.user_id')->join('batch','batch.id','=','batchclass.batch_id')->join('class','class.id','=','batchclass.class_id')->select('batch.*','class.*','batchclass.*','users.*','userclassbatch.*')->get();
        //dd($currentbatch);
        //dd($siswa);
        return view('adminpembayaran',  compact('siswa'));
    }

    public function carinama(Request $request){

        $name = '%'.$request->namasiswa.'%';
        $siswa = $siswa = DB::table('userclassbatch')->join('batchclass','batchclass.id','=','userclassbatch.batchclass_id')->where('batchclass.is_active','>',0)->join('users','users.id','=','userclassbatch.user_id')->where('users.name','like',$name)->join('batch','batch.id','=','batchclass.batch_id')->join('class','class.id','=','batchclass.class_id')->select('batch.*','class.*','batchclass.*','users.*','userclassbatch.*')->get();
        //dd($listsiswa);
        return view('adminpembayaran',  compact('siswa'));
    }

    public function konfirm($id){
        //dd($id);
        $class = DB::table('userclassbatch')->where('id','=',$id)->update(['is_paid' => 1]);
        //dd($class);
        return redirect()->route('pembayaran');
    }

    public function detailkelas($id){
        $now = Carbon::now()->format('Y-m-d');
        $classes = DB::table('batchclass')->where('batchclass.is_active','>',0)->join('class','class.id','=','batchclass.class_id')->where('class.id','=',$id)->join('batch','batch.id','=','batchclass.batch_id')->select('batch.*','class.*','batchclass.*')->first();
        $siswas = DB::table('userclassbatch')->where('userclassbatch.batchclass_id','=',$classes->id)->join('users','users.id','=','userclassbatch.user_id')->get();
        $tugas = DB::table('assignment')->where('batchkelas_id','=',$classes->id)->get();
        $materi = DB::table('materi')->where('materi_batchclass_id','=',$classes->id)->get();
        $data = [
            'classes' => $classes,
            'siswas' => $siswas,
            'tugas' => $tugas,
            'materi' => $materi
        ];
        //dd($classes);
        return view('admindetail',  compact('data'));
    }

}
