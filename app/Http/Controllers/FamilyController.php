<?php

namespace App\Http\Controllers;

use App\Family;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        $family=new Family();
        $family->name=$request->name;
        if ($family->save()){
            $user=auth('api')->user();
            $user->id_family=$family->id;
            //dd($user);
            $user->save();
            return json_encode(['success'=>'Family added']);
        }else{
            return json_encode(['error'=>'Not added']);
        }
    }

    /**
     * @param Request $request
     * Add a member to a family
     * @return string
     */
    public function addMember(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'isParent'=>'required'
        ]);

        $user=User::find($request->id);
        $user->id_family=auth('api')->user()->id_family;
        $user->isParent=$request->isParent;
        if($user->save()){
            return json_encode(['success'=>'Member added to family']);
        }else{
            return json_encode(['error'=>'Not added']);
        };

    }

    /**
     * @param Request $request
     * Search about other family members
     * @return mixed
     */
    public function search(Request $request){
        $members=User::where('name','like',"{$request->q}%")->get()->take(3);
        return $members;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function edit(Family $family)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Family $family)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function destroy(Family $family)
    {
        //
    }
}
