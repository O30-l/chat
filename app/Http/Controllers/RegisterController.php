<?php
namespace App\Http\Controllers;
use App\Http\Controllers;
use Illuminate\Http\Request;
use App\MyClass\Ucpaas;
use App\MyClass\Auth;
use App\User;
use Mail;
class RegisterController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            return back();
        }else{
            return view('home.register');
        }

    }

    public function sendEmail(Request $request)
    {
        if(!User::where('email',$request -> to) -> count()){
            $code = create_code();

            $bool = Mail::send('email.register',['app_name'=>config('app.name'),'code'=>$code],function($message) use ($request){
                $message -> to($request -> to)->subject('注册验证');
            });
            //存储到session里
            $_SESSION['code']=[
                $code,
                'to'=>[
                    $request->to,
                    'type'=>'email'
                ],
                'expiretime'=>time()+180
            ];
            return ['state'=>true,'info'=>'发送成功请注意查收'];
        }else{
            return ['state'=>false,'info'=>'此邮箱已经被注册'];
        }
    }

    public function sendMobile(Request $request)
    {
        if(!User::where('mobile',$request -> to) -> count()){

            //生成验证码
            $code = create_code();
            $Ucpaas = new Ucpaas(['accountsid'=>'a9aa2f9778f671a04dd9a7dfe0adfe3f','token'=>'febb13be2e62da104443573c87ec118c']);
            $r = $Ucpaas -> SendSms('6e60094d6ea64144854f65a6a274a46a',284579,config('app.name').','.$code,$request->to,'');
            if(substr($r,21,6) == 000000){

                //存储到session里
                $_SESSION['code']=[
                    $code,
                    'to'=>[
                        $request->to,
                        'type'=>'mobile'
                    ],
                    'expiretime'=>time()+180
                ];
                return ['state'=>true,'info'=>'发送验证码成功请注意查收'];
            }else{
                return ['state'=>false,'info'=>'发送验证码失败请稍后尝试'];
            }
        }
    }


    //验证验证码
    public function verification(Request $request)
    {
        //判断验证码是否为空
        if(!$request -> code){
            return ['state'=>false,'info'=>'请填写验证码'];
        }

        //判断是否发送
        if(!isset($_SESSION['code'])){
            return ['state'=>false,'info'=>'还没有发送验证码'];
        }

        //判断是否正确
        if($_SESSION['code'][0]==strtolower($request['code'])){


            //判断是否过期
            if($_SESSION['code']['expiretime']<time()){
                return ['state'=>false,'info'=>'验证码已经过期'];
            }

            //判断验证方式
            if($request->toArray()['to']['to'] != $_SESSION['code']['to'][0] || $request->toArray()['to']['type'] != $_SESSION['code']['to']['type']){
                return ['state'=>false,'info'=>'验证方式和验证码不对应'];
            }

            return ['state'=>true,'info'=>''];

        }else{
            return ['state'=>false,'info'=>'验证码错误'];
        }
    }

    public function create(Request $request)
    {
        $accounts = User::select('account')->get()->toArray();

        $r = User::create(array_merge(['account'=>$this -> createAccount($accounts)],$request->toArray()));
        if($r){
            return LoginController::login($r -> toArray());
        }else{
            return back();
        }
    }


    public function createAccount($accounts)
    {
        $account='';
        for($i=0;$i<5;$i++){
            $account.=rand(0,9);
        }
        if(in_array($account,$accounts)){
            $account = $this -> createAccount($accounts);
        }
        return $account;
    }
}
