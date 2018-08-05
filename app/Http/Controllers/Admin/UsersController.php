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
        $mods = UserMod::orderBy('id','desc')->paginate(15);

        return view('admin.user.lists', compact('mods'));

    }

    
    public function create()
    {
        return view('admin.user.create');
    }

    
    public function store(Request $request)
    {
      /*  //dd($request); exit;
        $mod = new UserMod;
        $mod->name = $request->name;
        $mod->email = $request->email;
        $mod->password = bcrypt($request->password);
        $mod->save();*/

        request()->validate([
            'name' => 'required|min:2|max:50',
            'surname' => 'required|min:2|max:50',
            'mobile' => 'required|numeric',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'age' => 'required|numeric',
            'confirm_password' => 'required|min:6|max:20|same:password',
        ], [
            'name.required' => 'Name is required',
            'name.min' => 'Name must be at least 2 characters.',
            'name.max' => 'Name should not be greater than 50 characters.',
        ]);


        $mod = new UserMod;
        $mod->email    = $request->email;
        $mod->password = bcrypt($request->password);
        $mod->name     = $request->name;
        $mod->surname  = $request->surname;
        $mod->mobile   = $request->mobile;
        $mod->age      = $request->age;
        $mod->address  = $request->address;
        $mod->city     = $request->city;
        $mod->save();

        return redirect('admin/users')
                ->with('success', 'User ['.$request->name.'] created successfully.');


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
        $item = UserMod::find($id);
        return view('admin.user.edit',compact('item'));
    }

    
    public function update(Request $request, $id)
    {
      /*  $mod = UserMod::find($id);
        $mod->name = $request->name;
        $mod->email = $request->email;
        $mod->password = bcrypt($request->password);
        $mod->save();
        echo "success find update";*/

        request()->validate([
            'name' => 'required|min:2|max:50',
            'surname' => 'required|min:2|max:50',
            'mobile' => 'required|numeric',
            'password' => 'required|min:6',
            'age' => 'required|numeric',
            'confirm_password' => 'required|min:6|max:20|same:password',
        ], [
            'name.required' => 'Name is required',
            'name.min' => 'Name must be at least 2 characters.',
            'name.max' => 'Name should not be greater than 50 characters.',
        ]);

        $request->validated();
        $mod = UserMod::find($id);
        $mod->name     = $request->name;
        $mod->surname  = $request->surname;
        //$mod->email    = $request->email;
        $mod->mobile   = $request->mobile;
        $mod->surname  = $request->surname;
        $mod->age      = $request->age;
        $mod->address  = $request->address;
        $mod->city     = $request->city;
        $mod->save();

        return redirect('admin/user')
                    ->with('success', 'User ['.$request->name.'] updated successfully.');

    }

    public function destroy($id)
    {
         $mod = UserMod::find($id);
         $mod->delete();
        echo "success find delete";
    }
}
