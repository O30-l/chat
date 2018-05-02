<?php
namespace App\Http\Controllers;
use DeviceDetector\Parser\Device\DeviceParserAbstract;
use DeviceDetector\DeviceDetector;
use Illuminate\Http\Request;
use App\MyClass\Auth;
use App\Login_log;
use App\User;
class LoginController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            return view('home.index');
        }else{
            return view('home.login');
        }
    }

    static public function get_client_info()
    {
        //获取客户端信息
        DeviceParserAbstract::setVersionTruncation(DeviceParserAbstract::VERSION_TRUNCATION_NONE);
        $dd = new DeviceDetector($_SERVER['HTTP_USER_AGENT']);
        $dd->discardBotInformation();
        $dd->skipBotDetection();
        $dd->parse();
        if ($dd->isBot()) {
            return $dd->getBot();
        } else {
            return [
                'clientInfo' => $dd->getClient(),
                'osInfo' => $dd->getOs(),
                'device' => $dd->getDevice(),
                'brand' => $dd->getBrandName(),
                'model' => $dd->getModel()
            ];
        }
    }
    public function validation(Request $request)
    {
        $r = User::where(['password'=>$request->password])->get()->toArray();
        $bool = false;
        foreach($r as $v){
            if(in_array($request->account,$v)){
                $bool=true;
            }
        }
        if($bool){
            return self::login($v);
        }else{
            swal(['type'=>'error','title'=>'OMG!','content'=>'账号或者密码错误']);
            return back();
        }
    }

    static public function login($data)
    {
        $login_info = self::get_client_info();
        Login_log::create([
            'user_id'=>$data['id'],
            'login_info'=>json_encode($login_info),
            'login_time'=>time()
        ])->toArray();
        $_SESSION['user']=$data;
        return redirect('/');
    }
}
