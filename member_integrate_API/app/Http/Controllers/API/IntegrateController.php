<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;

class IntegrateController extends Controller
{
     public function index()
    {
       
    }


    //snack APIにて利用する。chatアプリから直接requestする。
    public function getMember1(Request $request){
        // chatアプリから送られてきたメールアドレスとパスワードを取得
        $mail = $request->input('mail');
        $password = $request->input('password');

        //データを受け取っているかテスト
        // return response()->json([
        //     'mail'=>$mail
        // ]); しっかり、データを受け取り、リスポンスできていることを確認。間違いはこれより下か？

        
        // Snackデータベースから該当するユーザー情報を取得
        $member = Member::where('mail', $mail)
            ->where('pass', $password)
            ->first();

           // dd($member); // debugする

            //この時点で、return してみる。この結果はうまくいきました。
            //すなわち、APIリクエストにより、データを受け取り、snackDBから一致するものを探し、返すまではできてる。
        //    return response()->json([
        //         'mail'=>$member->mail,
        //         'name'=>$member->name,
        //     ]);



        if (!isset($member)) {
            return response()->json([
                "error"=>"お探しのアカウントは見つかりませんでした。"
            ]);
        }

        // ユーザー情報と画像データを含んだレスポンスを返す
        return response()->json([
            'name' => $member->name,
            'mail' => $member->mail,
            'password'=>$member->pass,
            'image'=>$member->image,
            'error'=>null,
        ]);
    }



    


    
    //2023.6.26 Chat APIにて利用する。snackアプリから直接requestする。
    public function getMember2(Request $request){
        // chatアプリから送られてきたメールアドレスとパスワードを取得
        $mail = $request->input('mail');
        $password = $request->input('pass');

        //データを受け取っているかテスト。テストは成功
        // Chatデータベースから該当するユーザー情報を取得
        $member = Member::where('mail', $mail)
            ->where('password', $password)
            ->first();

        if (isset($member)) {
            return response()->json([
                'name'=>$member->name,
                'mail'=>$member->mail,
                'pass'=>$member->password,
                'image'=>$member->image,
                'error'=>null,
            ]);
        }else{

            // ユーザー情報と画像データを含んだレスポンスを返す
            
            return response()->json([
                "error"=>"お探しのアカウントは見つかりませんでした。"
            ]);
        }
    }


    //DB接続が正常にできるかを単独で確認。　データベース接続自体はうまくいっています。
    public function checkDB(Request $request){
        $mail="kinako.com";
        $password="kinako";

        $member = Member::where('mail', $mail)
            ->where('password', $password)
            ->first();
        
        return view("checkDB",[
            'member'=>$member
        ]);
    }




    
}
