<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MFamily;
use Validator;

class FamillyController extends Controller
{
    public function index(Request $request)
    {
        $families         = MFamily::select('*')->OrderbY('parent', 'asc');
        if($request->id === 'cucu'){
            $families->whereNot('parent', 1)->whereNot('parent', 0);
        }else if($request->id === 'female'){
            $families->whereNot('parent', 1)->whereNot('parent', 0)->where('gender', 2);
        }else if($request->id == 2){
            $families->where('id', $request->id);
        }else if($request->id === 'sepupu'){
            $families->whereNot('parent', 1)->whereNot('parent', 0)->where('gender', 1)->whereNot('id', 10);
        }
        $family = $families->get();
        $pathurl = request()->path();
        $variable = substr($pathurl, 0, strpos($pathurl, "/"));
        if ($variable === 'api'){
            return response()->json($family);
        }else{
            if($request->ajax()){
                 if($request->id !== '' && $request->id !== 'all'){
                     return response()->json($family);
                 }else{
                     $result = $this->buildTree($family->toArray());
                     return view('family.ajaxdata', compact('result'));
                 }
            }else{
             $result = $this->buildTree($family->toArray());
             $family = json_encode($result);
                return view('family.index', compact('result'));
            }
        }
    }
    public function buildTree(array $elements, $options = [
        'parent_id_column_name' => 'parent',
        'children_key_name' => 'children',
        'id_column_name' => 'id'], $parentId = 0)
        {
        $branch = array();
        foreach ($elements as $element) {
            if ($element[$options['parent_id_column_name']] == $parentId) {
                $children = $this->buildTree($elements, $options, $element[$options['id_column_name']]);
                if ($children) {
                    $element[$options['children_key_name']] = $children;
                }else{
                    $element[$options['children_key_name']] = [];
                }
                $branch[] = $element;
            }
        }
        return $branch;
    }
    public function create()
    {
        $gender         = null;
        $family         = MFamily::OrderBy('parent', 'asc')->select('name', 'id')->get();
        return view('family.create', compact('gender', 'family'));
    }
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(),[
            'name'=>'required',
            'gender'=>'required',
            'parent' => 'required',
        ]);
        if ($validated->fails()) {
            $message = $validated->errors();
            return response()->json($message);
        }
        $storeFamilies              = new MFamily;

        $storeFamilies->name        = request()->name;
        $storeFamilies->gender      = request()->gender;
        $storeFamilies->parent      = request()->parent;
        $storeFamilies->save();

        return redirect()->route('family')->with(
            'message','Success Insert'
        );
        return response()->json($storeFamilies);
    }
    public function edit($id)
    {
        $vfamily        = MFamily::find($id);
        $family         = MFamily::OrderBy('parent', 'asc')->select('name', 'id', 'parent')->get();
        $gender         = $vfamily->gender;

        return view('family.edit', compact('vfamily', 'family', 'gender'));
    }
    public function update($id)
    {
        $family         = MFamily::find($id);

        $family->name        = request()->name;
        $family->gender      = request()->gender;
        $family->parent      = request()->parent;
        $family->save();

        return redirect()->route('family')->with(
            'message','Success Update'
        );
    }
}
