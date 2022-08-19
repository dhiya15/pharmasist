<?php


namespace App\Http\Controllers\Admin;

use App\Http\Requests\MagasinRequest;
use App\Models\Magasin;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class MagasinCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;

    public function setup()
    {
        $this->data['shop'] = Magasin::find(1);
    }

    protected function setupListOperation()
    {
        $this->crud->setListView('crud::shop');
    }

    public function updateShop(MagasinRequest $request)
    {

        $data = $request->validated();
        $disk = "uploads";
        $destination_path = "uploads/shop";
        $path = '/uploads/shop/';
        if (request()->hasFile('logo')) {
            $imageName = Str::random(15) . '.' . $request->logo->getClientOriginalExtension();
            $request->file('logo')->storeAs($destination_path, $imageName, $disk);
            $data['logo'] = $path . $imageName;
        }
        if ($request->website_under_maintenance){
            $data['website_under_maintenance'] = 1;
        }else{
            $data['website_under_maintenance'] = 0;
        }
        Magasin::where('id', 1)->update($data);
        \Alert::add('success', "L’élément a été modifier avec succès.")->flash();
        return redirect()->back();
    }
}



/*
namespace App\Http\Controllers\Admin;

use App\Http\Requests\MagasinRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class MagasinCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Magasin::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/magasin');
        CRUD::setEntityNameStrings('magasin', 'magasins');
    }

    protected function setupListOperation()
    {
        CRUD::column('logo');
        CRUD::column('name');
        CRUD::column('title');
        CRUD::column('description');
        CRUD::column('footer_short_des');
        CRUD::column('phone');
        CRUD::column('fax');
        CRUD::column('email');
        CRUD::column('country');
        CRUD::column('post_code');
        CRUD::column('address');
        CRUD::column('website');
        CRUD::column('twitter');
        CRUD::column('facebook');
        CRUD::column('instagram');
        CRUD::column('google_plus');
        CRUD::column('latitude');
        CRUD::column('longitude');
        CRUD::column('working_days');
        CRUD::column('working_hours');
        CRUD::column('website_under_maintenance');

    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(MagasinRequest::class);

        CRUD::field('logo');
        CRUD::field('name');
        CRUD::field('title');
        CRUD::field('description');
        CRUD::field('footer_short_des');
        CRUD::field('phone');
        CRUD::field('fax');
        CRUD::field('email');
        CRUD::field('country');
        CRUD::field('post_code');
        CRUD::field('address');
        CRUD::field('website');
        CRUD::field('twitter');
        CRUD::field('facebook');
        CRUD::field('instagram');
        CRUD::field('google_plus');
        CRUD::field('latitude');
        CRUD::field('longitude');
        CRUD::field('working_days');
        CRUD::field('working_hours');
        CRUD::field('website_under_maintenance');

    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
*/
