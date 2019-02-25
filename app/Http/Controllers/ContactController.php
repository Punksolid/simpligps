<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Middleware\IdentifyTenantConnection;
use App\Http\Requests\ContactRequest;
use App\Http\Resources\ContactResource;
use Hyn\Tenancy\Environment;
use Illuminate\Http\Request;

/**
 * Class ContactController
 * @package App\Http\Controllers
 * @resource Contacts
 */
class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware(IdentifyTenantConnection::class);
    }
    /**
     * Display a listing of the CONTACT.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::paginate();

        return ContactResource::collection($contacts);
    }

    /**
     * Store a newly created CONTACT in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        $contact = Contact::create($request->all());

        return ContactResource::make($contact);
    }

    /**
     * Display the specified CONTACT.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {

        return ContactResource::make($contact);

    }

    /**
     * Update the specified CONTACT in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
;        if ($contact->update($request->all())){
            return ContactResource::make($contact);
        }

        return response("Aconteció un error, no se pudo actualizar.");
    }

    /**
     * Remove the specified CONTACT from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        if ($contact->delete()){
            return response([
                "message" => "Se eliminó el contacto."
            ]);
        }

        return response("Aconteció un error");
    }

    public function attachtags(Contact $contact)
    {
        $contact->syncTags(\request()->tags);

        return ContactResource::make($contact->load("tags"));
    }

    public function filterTags(Request $request)
    {

        $contacts = Contact::query()->orderBy("created_at","DESC");
        $contacts->withAllTags($request->tags);

        return ContactResource::collection($contacts->paginate());
    }
}
