<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Apartment;
use App\User;
use App\Service;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $apartments = Apartment::where("user_id", Auth::id())->orderBy("created_at", "desc")->get();
        // $apartments = Apartment::all();


        return view('users.index', compact("apartments"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        return view("users.create", compact("services"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // TODO: DA MODIFICARE
        $request->validate($this->validationRules());

        $data = $request->all();
        $data["user_id"] = Auth::id();

        if (!empty($data["img_url"])) {
            $data["img_url"] = Storage::disk("public")->put("images", $data["img_url"]);
        }

        $newApartment = new Apartment();
        $newApartment->fill($data);
        // TODO: EMAIL
        $saved = $newApartment->save();
        if ($saved) {
            if(!empty($data['services'])){
                $newApartment->services()->attach($data['services']);
            }
            // EMAIL LOGIC

            return redirect()->route("user.apartments.show", $newApartment->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        return view("users.show", compact("apartment"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        return view("users.edit", compact("apartment"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
        $request->validate($this->validationRules());

        $data = $request->all();

        // IMG UPDATE
        if (!empty($data["img_url"])) {

            // delete previous img:
            if (!empty($apartment->img_url)) {
                Storage::disk("public")->delete($apartment->img_url);
            }

            // set new img:
            $data["img_url"] = Storage::disk("public")->put("images", $data["img_url"]);
        }

        $updated = $apartment->update($data);

        if ($updated) {
            return redirect()->route("users.show", $apartment->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        if (empty($apartment)) {
            abort("404");
        }

        $title = $apartment->title;

        $deleted = $apartment->delete();

        if ($deleted) {
            // remove img
            if (!empty($apartment->img_url)) {
                Storage::disk("public")->delete($apartment->img_url);
            }

            return redirect()->route("users.index")->with("$apartment-deleted", $title);
        }
    }

    private function validationRules()
    {
        return [
            "title" => "required|max:150",
            "description" => "required|max:1500",
            "img_url" => "required|image",
            "price" => "required",
            "room_qty" => "required",
            "bathroom_qty" => "required",
            "bed_qty" => "required",
            "sqr_meters" => "required",
            "is_visible" => "required",
            //******************************** INSERIRE MAPPA ALGOLIA POSIZIONE APPARTAMENTO */
        ];
    }
}
