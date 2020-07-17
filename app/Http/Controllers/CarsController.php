<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;
use App\User;
class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::all()->toArray();
        return view('car.car_index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('car.car_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //LAB 6
        $this->validate($request,[

            'make'=>'required',

            'model'=>'required',

            'produced_on'=>'required'

           ]);


        $cars= new Car();

        $cars->make= $request->input('make');
        $cars->model = $request->input('model');
        $cars->produced_on= $request->input('produced_on');
       
        $cars->save();
    
             return redirect()->route('car.index')->with('success', 'New Car Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cars = Car::find($id);
        return view('car.car_edit', compact('car', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //LAB 6
        $this->validate($request,[

            'make'=>'required',

            'model'=>'required',

            'produced_on'=>'required'

           ]);


        $cars= Car::find($id);

        $cars->make= $request->input('make');
        $cars->model = $request->input('model');
        $cars->produced_on= $request->input('produced_on');
       
    
        $cars->save();
       
             return redirect()->route('car.index')->with('success', 'Car Details Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cars = Car::find($id);
        $cars->delete();
        return redirect()->route('car.index')->with('success','Car Details Deleted Successfully');
    }
}
