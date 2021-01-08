# Smarthome Product Management
This is a small, school-based project to manage smart-home products for various companies using PHP and Laravel.

## Pages
There is going to be a **dashboard** showing statistics (the number of **Orders**, **Products and Services**) and the configuration/overview items.

On the **orders-page**, one should be able to see a table of orders for customers. If a user clicks on an entry, he/she can edit or delete it and see a more detailed view below.

On the **products- and services-page** you should be able to register new controllers and manage their services by clicking on the controllers. The service-overviews for certain controllers should be loaded lazily.

A **masterpage** should be used for all pages containing a logo and name with a link to the dashboard and a few nav-items on the right hand side, which collapse on smaller screens into an iteractive menu.

### Routing
As the described UI offers quite a few direct access methods, the routing specifications need to be adapted/restrained.

To provide a  quick overview over which functionalities are directly embedded in the UI the following section from the file web.php is included (which directly resulted after the planning phase):

```php
Route::get('/', function () {
    return view('dashboard')->with('companyData', Company::first());
})->name('dashboard');

Route::get('/imprint', function () {
    return view('imprint');
})->name('imprint');

//For assignment of an already existing service to another product - however: Make sure a service with the same licence number cannot be assigned twice to the same product
Route::post('/product/associate-service', [ProductController::class, 'AssociateService'])->name('product.associateService'); 
//For removing an assignment, product.service.destroy can be used as the service will only be deleted for the queried product-id

//Index and show not needed - there is only one instance shown on the dashboard
//On company.destroy, everything should be deleted as all of the data belongs to a company
Route::resource('company','App\Http\Controllers\CompanyController')->except(['index','show']); 
//Show is not needed as everything is displayed on the index page and the details-view can be accessed via JS
Route::resource('order','App\Http\Controllers\OrderController')->except(['show']);
//Show is redundant as it can be examined on the index page (as well as on the services.index-page for the assignment of the relationship)
Route::resource('product','App\Http\Controllers\ProductController')->except(['show']);
//The creation and listing directly takes place at the index-page of the service (so no create is needed - store, however, is needed)
Route::resource('product.service','App\Http\Controllers\ServiceController')->except(['create, show']); 
```
The relationship inside the _product.service_ route is modeled in a nested way to provide an easier way for accessing the product_id in the ServiceController. 

### Remark: Capitalizing the Route "AssociateService"
According to the used naming conventions, `associateService` should be written in `cammelCase` (not `PascalCase`). This is why it is written in this way in the route itself. 

However, because the contracting entity (Dipl.-Ing. Georg Ungerböck) insists on using `PascalCase` for naming methods, `ProductController.AssociateService()` has been named this way.
## Design-Adaptations for adding Services
Since services can directly be added to Products/Controllers in the Details-View, a combobox is obsolete regarding the implemented design. However, a combobox is used for referencing projects of Products in the Views for creating and editing Orders.

## Implementation
The following structure indicates how the Eloquent-ORM-System should be used to store the model Data hierarchically. 

_Hint: The applied naming-conventions can be seen at the bottom of the document._

 - **Products**
    - id: BigInt
    - controller_name: String
    - serial_number: UnsignedInteger (not necessarily unique - described later - short version: different company standards)
    - project_name: String (is later used to reference orders with projects)
    - registered_on: DateTime (it is assumed, that a product can be registered before or after the dataset has been created - otherwise created_at could be used. Hence, this is the default value.)
    - **Services** (belongs to at least one product)
        - id: BigInt
        - service_name: String
        - licence_number: UnsignedInteger
        - max_date: DateTime
        - enabled: Boolean
 - Service-Product M-to-N-Relationship Table (not a Model - reason for Many-To-Many described later)
    - service_id: FK for Products->id
    - product_id: FK for Services->id
 - **Orders**
    - id: BigInt (represents the Order-Number)
    - date_ordered: DateTime
    - reference_name: String
    - state: Enum (possible values: `Not yet ordered`, `Ordered`, `Finished`)
 - **Companies** (only one instance can exist - handled by CompanyController)
    - name: String
    - email_address: String
    - _contact_firstname_: String
    - _contact_lastname_: String
    
The **bold** statements are model classes and the _italic_ ones show that there is only one contact person associated with each company.

### Details for the Model
The following tutorial is used to model the **Many-To-Many-Relationship** regarding **Products** and **Services** (by using Eloquent):
https://laravel.com/docs/8.x/eloquent-relationships#one-to-many

This should result in the ability to use the relationship in the DB.

### Why is the Licence-Number not the PK of Services?
It is assumed, that different companies could refer to different Services in various ways so that the same licence number could **in the future** be used for multiple services. Thus, an ID, which is definitely unique, is used.

### Why is a Many-To-Many-Relationship used for Products and Services?
Imagine a customer having many sites, which use the same licences and are all moddeled as different controllers. Hence, it is convenient to be able to assign excactly the same Services to multiple Products as well - it can be disabled for all of them and the expiry-date will be synchronized easilly.

It is quite easy to understand that the other side of the relationship (Products) can have many Services as it is common for controllers to manage multiple services. 

### Migrations
The Structure from the Implementation-Part is used to infer the four needed migrations:
1. `create_services_table`
2. `create_products_table`
3. `create_products_services_table` (for the Many-To-Many-Relationship - only contains foreign keys)
4. `create_orders_table`
5. `create_companies_table`

_Note that the order is important as foreign key constraints should be used_
 
Additionally, every record should have the `timestamps`-field to be able to check the modification and creation times.

### Controllers
With the used approach, **every Model-Object** is going to have its own Controller-Object, although the Companies-Controller will only be used if no company instance has already been configured, so there is only going to be one company. Thus, the index-Method of the Companies' CRUD-Controller is not implemented. Furthermore, the same Blade-View should be used for **Companies.Show**, **Companies.Edit** and **Companies.Create** in order to save time.

The Controller of the Service is also quite special as the functionality of the Create-Method and the Show-Method is already going to be implemented inside the **Products.Index** Page. The **Products.Index**-Page also obsoletes the **Products.Show** as well as the **Service.Show**-Page as certain elements are going to be highlighted via JS and Bootstrap. The **Orders.Show**-Page is going to be integrated to the **Orders.Index** as well.

The Services-Model-Classes are displayed and managed within the Products-Controller to reduce the overall complexity.

### Creating and editing Entries
Since creating and editing entries is very similar for all Models, a blade-View called DataStructure-Manager "**manageDataStructure.blade.php**" should be created to provide simple access and avoid code reuse.
### Seeding
Should be done using a `Factory` for the **Orders** and the **Products** (directly including the **Services**). As there is only one company for the application, no seeder is going to be created for it.

### Concrete Commands
The following commands are used to generate the models, factories, seeders and controllers:
1. `php artisan make:model Product -msfc`
2. `php artisan make:model Service -mfc` (the factory is also necessary to conveniently seed the product - seeding should happen inside the ProductSeeder and its factory)
3. `php artisan make:model Order -msfc`
4. `php artisan make:model Company -msfc`

The Company-Seeder only creates exactly one instance of a company which is an exception.

### Naming conventions
Should be applied from the following link: https://webdevetc.com/blog/laravel-naming-conventions/#section_table-columns-names

For instance: Lower _snake_case_ is used for accessing Model Columns. However, for names in forms _camelCase_ should be used.
