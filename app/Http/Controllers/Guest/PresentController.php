<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Present;
use Illuminate\Support\Facades\Validator;

class PresentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function index()
    {
        $presents = Present::all();
        return view('presents.index',compact('presents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * 
     */
    public function create()
    {
        return view('presents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     */
    public function store(Request $request)
    {
        $formData = $this->validation($request->all());
        
        $newPresent = Present::create($formData);

        return redirect()->route('presents.show', $newPresent->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * 
     */
    public function show(Present $present)
    {
        return view('products.show', compact('present'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * 
     */
    public function edit(Present $present)
    {
        return view('products.edit', compact('present'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * 
     */
    public function update(Request $request, $id)
    {
        $formData = $this->validation($request->all());
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * 
     */
    public function destroy($id)
    {
        //
    }

    // Validation
    private function validation($data) {
        $validator = Validator::make($data, [
            'name' => 'required|min:5|max:50',
            'surname' => 'required|min:5|max:50',
            'present' => 'required|max:100',
            'address' => 'requiredmax:250',
            'good_or_evil' => 'required|max:50',
            'id_elf' => 'required|max:10',
        ], [
            'name.required' => 'Il nome è obbligatorio.',
            'name.min' => 'Il nome deve essere lungo almeno :min caratteri.',
            'name.max' => 'Il nome non può superare i :max caratteri.',
            'surname.required' => 'Il cognome è obbligatorio.',
            'surname.max' => 'Il cognome non può superare i :max caratteri.',
            'present.required' => 'Il regalo è obbligatorio.',
            'present.max' => 'Il regalo non può superare i :max caratteri.',
            'address.required' => 'L\'indirizzo è obbligatorio.',
            'address.max' => 'L\'indirizzo non può superare i :max caratteri.',
            'good_or_evil.required' => 'Il comportamento del bambino è obbligatorio.',
            'good_or_evil.max' => 'Il comportamento del bambino non può superare i :max caratteri.',
            'id_elf.required' => 'La matricola dell\'elfo è obbligatorio.',
            'id_elf.max' => 'La matricola dell\'elfo non può superare i :max caratteri.',

        ])->validate();

        return $validator;
    }
}
