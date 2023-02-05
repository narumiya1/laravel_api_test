<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StuddentsResource;
use App\Models\Studdents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class StuddentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $studdents = Studdents::all();
        return new StuddentsResource(true, 'Data Studsents All', $studdents);
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
        //
        $validators = FacadesValidator::make(
            $request->all(),
            [
                'idnumber' => 'required|unique:studdents,idnumber',
                'fullname' => 'required',
                'gender' => 'required',
                'phone' => 'required|numeric|unique:studdents,phone',
                'address' => 'required',
                'emailaddress' => 'required|email|unique:studdents,emailaddress',

            ]
        );

        if ($validators->fails()) {
            return response()->json($validators->errors(), 442);
        } else {
            $studdents = Studdents::create(
                [
                    'idnumber' => $request->idnumber,
                    'fullname' => $request->fullname,
                    'gender' => $request->gender,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'emailaddress' => $request->emailaddress,
                    'photo'=>''

                ]

            );

            return new StuddentsResource(true, 'Data berhasil ditambahkann',$studdents);
        }
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
        $studdents = Studdents::find($id);
        if ($studdents) {
            return new StuddentsResource(true, 'data ditemukan', $studdents);
        } else {
            return response()->json([
                'message' => 'data not founded ! '
            ], 442);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
        $validators = FacadesValidator::make(
            $request->all(),
            [
                'fullname' => 'required',
                'gender' => 'required',
                'phone' => 'required|numeric|unique:studdents,phone',
                'address' => 'required',
                'emailaddress' => 'required|email|unique:studdents,emailaddress',

            ]
        );

        if ($validators->fails()) {
            return response()->json($validators->errors(), 442);
        }else{
            $studdents = Studdents::find($id);
            if($studdents){
                $studdents->fullname = $request->fullname;
                $studdents->gender = $request->gender;
                $studdents->phone = $request->phone;
                $studdents->address = $request->address;
                $studdents->emailaddress = $request->emailaddress;
                $studdents->save();


                return new StuddentsResource(true, 'data berhasil di update', $studdents);
            }else{
                return response()->json([
                    'message' => 'Data not foundd'
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
