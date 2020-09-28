<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Restaurant;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Log;


// サービスファイルの読み込み
use App\Services\CheckExtensionServices;
use App\Services\FileUploadServices;

//これ追記（画像アップロード・保存）
// インストールしたIntervention/ImageがImageクラスとして使用できるようになる
use Intervention\Image\Facades\Image;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    // トレイト（RegisterUsers）を使っている
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
            // return
            return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'image' => ['required','file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2000'], //この行を追加
            'age'=> ['required', 'string', 'max:255'],//この行を追加
            'sex'=> ['required', 'string', 'max:255'],//この行を追加
            // 'self_introduction' => ['string', 'max:255'], //この行を追加
            // 'married'=> ['string', 'max:255'],//この行を追加
            // 'address'=> ['string', 'max:255'],//この行を追加
            // 'type_of_wine'=> ['string', 'max:255'],//この行を追加v
            // 'verify_of_wine'=> ['string', 'max:255'],//この行を追加
            // 'producing_area'=> ['string', 'max:255'],//この行を追加
            // 'favorite_food'=> ['string', 'max:255'],//この行を追加
            // 'price_range'=> ['string', 'max:255'],//この行を追加
            // 'favorite_restaurant'=> ['string', 'max:255'],//この行を追加
        ]);
        // dd($validate->errors());
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */


    protected function create(array $data)
    {
        //引数 $data から name='image'を取得(アップロードするファイル情報)
        $imageFile = $data['image'];

        $list = FileUploadServices::fileUpload($imageFile);

        // 3つの変数が配列でreturnされるので、PHPのlist関数を使い、元の3つの変数に分割しておく
        list($extension, $fileNameToStore, $fileData) = $list;

        $data_url = CheckExtensionServices::checkExtension($fileData,$extension);

        //画像アップロード(Imageクラス makeメソッドを使用)
        $image = Image::make($data_url);

        //画像を横400px, 縦400pxにリサイズし保存
        $image->resize(400,400)->save(storage_path() . '/app/public/images/' . $fileNameToStore );


        // $dataに入力された情報が入ってくるのでusersテーブルに詰める
            $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'sex' => $data['sex'],
            'age' => $data['age'],
            'image' => $fileNameToStore,
            // 'address' => $data['address'],
            // 'married' => $data['married'],
            // 'type_of_wine' => $data['type_of_wine'], 
            // 'verify_of_wine' => $data['verify_of_wine'],
            // 'producing_area' => $data['producing_area'],
            // 'favorite_food' => $data['favorite_food'],
            // 'price_range' => $data['price_range'],
            // 'favorite_restaurant' => $data['restaurant'],
            // 'favorite_restaurant' => $data['favorite_restaurant'],
            // 'self_introduction' => $data['self_introduction'],
            ]);

           $this->redirectTo = '/users/register/'.$user->id;
           return $user;

    }


}
