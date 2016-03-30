<?php

namespace App\Http\Controllers;
use App\Company;
use App\Specialisation;
use App\Proposition;
use Image;
use Illuminate\Http\Request;
use App\Http\Requests;

class PublicCatalogConroller extends Controller
{

    public function index () {

        $data['companies'] = Company::orderBy('created_at', 'desc')
            ->paginate(10);

        return $this->getPage($data);

    }


    public function specialisation ($id) {

        $data['companies'] = Specialisation::find($id)
            ->companies()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return $this->getPage($data);

    }

    public function proposition ($id) {

        $data['companies'] = Proposition::find($id)
            ->companies()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return $this->getPage($data);

    }

    public function filter ($letter) {

        $data['companies'] = Company::where('name', 'LIKE', $letter.'%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);            

        return $this->getPage($data);

    }

    public function search (Request $request) {

        $data['companies'] = Company::where('name', 'LIKE', '%'.$request->search.'%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);            

        $data['search'] = $request->search;

        return $this->getPage($data);
      

    }

    protected function getPage ($data) {

        $data['specialisations'] = Specialisation::all();

        $data['propositions'] = Proposition::all();

        return view('public.catalog.index', $data );

    }

    public function company ($id) {

        return view('public.catalog.company');

    }
}
