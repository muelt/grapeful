<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

// これはupdateメソッドの引数として使い、フォームリクエスト(バリデーション)を適用させる
use App\Http\Requests\ProfileRequest;

// App\User.phpのUserモデルを呼び出せるようにする
use App\User;
use App\Restaurant;
use Intervention\Image\Facades\Image;

// サービスファイルの読み込み
use App\Services\CheckExtensionServices;
use App\Services\FileUploadServices;


class UserController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    
    public function show($id){
        // EloquentでDB情報を取得=>Userモデル内に指定のidがあれば取得
        $user = User::findorFail($id);

        // 情報を変数に入れてviewに渡してあげる
        // 自分自身だった場合は自分のプロフィールページ（編集、ログアウト可能）
        if($id == Auth::id()){
            // dd($user);
            return view('users.show', compact('user'));
            //  他のユーザーのページに飛ぶ場合は、閲覧のみページ   
        }else{
            return view('users.users_show', compact('user'));
        }
     
    }

    public function edit($id){
        $user = User::findorFail($id);

        return view('users.edit', compact('user'));
    }

    public function update($id, ProfileRequest $request){
        $user = User::findorFail($id);

        // <--ここから画像のリネーム/リサイズ処理-->
        // 画像がアップロードされていれば
        if(!is_null($request['image'])){
            $imageFile = $request['image'];

            // ユニークなファイル名を生成
            $list = FileUploadServices::fileUpload($imageFile);
            list($extension, $fileNameToStore, $fileData) = $list;

            // 拡張子の種類によって、付与する情報を変える
            $data_url = CheckExtensionServices::checkExtension($fileData, $extension);
            
            // 画像をリサイズして保存
            $image = Image::make($data_url);
            $image->resize(400,400)->save(storage_path() . '/app/public/images/' . $fileNameToStore );

            $user->image = $fileNameToStore;
        }
        // <--ここまで-->

        $user->name = $request->name;
        $user->email = $request->email;
        $user->sex = $request->sex;
        $user->age = $request->age;
        $user->married = $request->married;
        $user->self_introduction = $request->self_introduction;
        $user->age = $request->age;
        $user->address = $request->address;
        $user->type_of_wine = $request->type_of_wine;
        $user->verify_of_wine = $request->verify_of_wine;
        $user->producing_area = $request->producing_area;
        $user->favorite_food = $request->favorite_food;
        $user->price_range = $request->price_range;
        $user->favorite_restaurant = $request->favorite_restaurant;

        $user->save();

        return redirect('home');
    }
}
