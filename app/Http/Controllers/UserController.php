<?php

namespace App\Http\Controllers;

use App\Models\networks;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(){
        return view('UserRegister');
    }
    public function register(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required',
            'cpassword'=>'required|same:password',
        ]);
        $referal_code=str::random(15);
        $token=str::random(30);
        if(isset($request->referal_code)){
            $parent_user_id=User::where('referal_code',$request->referal_code)->get();
            if(count($parent_user_id)>0){
               $users= User::insertGetId([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'password'=>Hash::make($request->password),
                    'referal_code'=>$referal_code,
                    'remember_token'=>$token,
                ]);
                $networks=networks::insert([
                    'referal_code'=>$request->referal_code,
                    'user_id'=>$users,
                    'parent_referal_id'=>$parent_user_id[0]['id'],
                ]);
               return redirect()->route('user.index')->with('referal_code','Registered success with referal code');
            }else{
                return back()->with('error','Invalid referal code');
            }
 
        }else{
            User::insert([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'referal_code'=>$referal_code,
                'remember_token'=>$token,
            ]);
            $domain=URL::to('/');
            $data['url']=$domain.'/referal-code/'.$referal_code;
            $data['name']=$request->name;
            $data['email']=$request->email;
            $data['password']=$request->password;
            $data['title']="Register Email";
            Mail::send('email.emailregistertemplate',['data'=>$data],function($message) use($data){
                $message->to($data['email'])->subject($data['title']);
            });
            // return redirect()->route('user.index')->with('success','User Register Successfully');
            // Email Verification
            $data['url2']=$domain.'/email-verification?token='.$token;
            $data['name']=$request->name;
            $data['email']=$request->email;
            $data['title']="Register Email";
            Mail::send('email.emailverification',['data'=>$data],function($message) use($data){
                $message->to($data['email'])->subject($data['title']);
            });
            return redirect()->route('user.index')->with('verify','Verification email has been sent to your mail');
 
        }

    }
    public function referal_code(Request $request){
            $referal=$request->ref;
            $refid=User::where('referal_code',$request->ref)->get();
            if(count($refid)>0){     
                return view('referalcodeview',compact('referal'));
            }
            else{
                  return view('error');
            }
        }
        public function error(){
            return view('error');
        }
        public function emailverified($token){
            $users=User::where('remember_token',$token)->get();
            if(count($users)>0){
              if($users[0]['is_verified']==1){
                return view('emailverified',['message'=>'your email is already registered']);
              }
                 User::where('id',$users[0]['id'])->update([
                    'is_verified'=>1,
                    'email_verified_at'=>date('Y-m-d H:i:s')
                 ]);
                return view('emailverified',['message'=>'Your '.$users[0]['email'].' mail registered successfully']);
            }else{
                return view('emailverified',['message'=>'4040 page not found!']);
            }
        }
        public function loadlogin(){
            return view('login');
        }
        public function login(Request $request){
            $request->validate([
                'email'=>'required|email',
                'password'=>'required',
            ]);
            $user=User::where('email',$request->email)->first();
            if(!empty($user)){
                if($user->is_verified==0){
                    return back()->with('message','Verify your email first');
                }
                $userauth=$request->only('email','password');
                if(Auth::attempt($userauth)){
                    return redirect('/dashboard');
                }
                else{
                    return back()->with('message','Invalid login crediantials');
                }
            }else{
                return back()->with('message','Email  not register yet');

            }
        }

        public function logout(Request $request){
            $request->session()->flush();
            Auth::logout();
            return redirect('/login');
        }
        public function dashboard(){
            // Count Point
            $networks=networks::where('parent_referal_id',Auth::user()->id)->orWhere('user_id',Auth::user()->id)->count();
            $networkdata=networks::with('user')->where('parent_referal_id',Auth::user()->id)->get();
            return view('dashboard',compact('networks','networkdata'));
        }
        public function delete(Request $request){
            if(Auth::user()){
                $user=User::where('id',Auth::user()->id)->delete();
                $request->session()->flush();
                return redirect('/login');
            }
        }
    }


