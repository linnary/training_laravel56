<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User as UserMod;
use App\Model\Shop as ShopMod;
use App\Model\Product as ProductMod;
class UsersController extends Controller
{
    
    public function index()
    {
         /*  $mods = UserMod::all();
           
        foreach ($mods as $item) {
            echo $item->name. "<br />";
        }*/
        /*return view('test')->with('name', 'My Name')
                           ->with('surname', 'My SName')
                           ->with('email', 'Name@hotmail.com');*/
        /*$data =[
            'name' => 'My Name',
            'surname' => 'My SurName',
            'email' => 'myemail@gmail.com'
        ];
         //return view('test', $data);

        $item = [
            'item1' => 'My Value1',
            'item2' => 'My Value2'  
        ];

        $results = [
            'data' => $data,
            'item' => $item
        ];
        */
        /*
         $data = [
           'name' => 'My Name',
           'surname' => 'My SurName',
           'email' => 'myemail@gmail.com'
         ];

        $user = UserMod::find(1);

        $mods = UserMod::all();
        return view('template', compact('data', 'user', 'mods'));
        */
        $mods = UserMod::paginate(15);

        return view('admin.user.lists', compact('mods'));

    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //dd($request); exit;
        $mod = new UserMod;
        $mod->name = $request->name;
        $mod->email = $request->email;
        $mod->password = bcrypt($request->password);
        $mod->save();
        echo "success";

    }

    
    public function show($id)
    {
        /*echo "<br />";
        $mod = UserMod::find($id);
        echo $mod->name." ".$mod->surname. " => is owner Shop : ".$mod->shop->name;
        echo "<br />";

        $shop = UserMod::find($id)->shop;
        echo $shop->name; ////
        $mod = ShopMod::find($id);
        echo $mod->name;

        echo "<br />";
        echo $mod->user->name; 
        ////////////////////////////////
        $products = ShopMod::find(1)->products;
 
        foreach ($products as $product) {
            echo $product->name;

            echo "<br />";
        }

        echo "<br /> OR <br /><br />";

        $shop = ShopMod::find($id);
        echo $shop->name;
        echo "<br />";

        foreach ($shop->products as $product) {
            echo $product->name;
            echo "<br />";
        }
        */
        $product = ProductMod::find($id);
        echo "Product Name is ".$product->name;
        echo "<br />";
        echo "Shop Owner is ".$product->shop->name;

    }

/**************************************************/
    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        $mod = UserMod::find($id);
        $mod->name = $request->name;
        $mod->email = $request->email;
        $mod->password = bcrypt($request->password);
        $mod->save();
        echo "success find update";
    }

    public function destroy($id)
    {
         $mod = UserMod::find($id);
         $mod->delete();
        echo "success find delete";
    }
}
