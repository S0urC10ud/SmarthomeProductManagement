# Smarthome Product Management
This is a small, school-based project to manage smart-home products for various companies using PHP and Laravel.

## Pages
There is going to be a **dashboard** showing statistics (the number of **Orders**, **Products and Services**) and the configuration/overview items.

On the **orders-page**, one should be able to see a table of orders for customers. If a user clicks on an entry, he/she can edit or delete it and see a more detailed view below.

On the **products- and services-page** you should be able to register new controllers and manage their services by clicking on the controllers. The service-overviews for certain controllers should be loaded lazily.

A **masterpage** should be used for all pages containing a logo and name with a link to the dashboard and a few nav-items on the right hand side, which collapse on smaller screens into an iteractive menu.

## Implementation
The following structure indicates how the Eloquent-ORM-System should be used hierarchically. 

 - **Products**
    - ID
    - Controller-Name
    - Serial-Number (not necessarily unique)
    - Project-Name
    - **Services**
        - ID
        - Service-Name
        - Licence-Number
        - Max-Date
        - Enabled-Flag
 - **Orders**
    - Order-Number (unique --> id)
    - Ordered-Date
    - Reference-Name
    - State-String (possible values: `Not yet ordered`, `Ordered`, `Finished`)
 - **Companies**
    - Company-Name
    - Company-EMail-Address
    - _Contact-Firstname_
    - _Contact-Lastname_
    
The **bold** statements are model classes and the _italic_ ones show that there is only one contact person associated with each company.

### Details for the Model
The following tutorial is used to model the **Many-To-Many-Relationship** regarding **Products** and **Services** (by using Eloquent):
https://laravel.com/docs/8.x/eloquent-relationships#one-to-many

This should result in the ability to use the relationship in the DB.

### Why is the Licence-Number not the PK of Services?
It is assumed that different companies could refer to different Services in various ways so that the same licence number could **in the future** be used for multiple services. Thus, an ID, which is definitely unique, is used.

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

### Seeding
Should be done using a `Factory` for the **Orders** and the **Products** (directly including the **Services**). As there is only one company for the application, no seeder is going to be created for it.

### Concrete Commands
The following commands are used to generate the models, factories, seeders and controllers:
1. `php artisan make:model Product -msfc`
2. `php artisan make:model Service -mfc` (the factory is also necessary to conveniently seed the product - seeding should happen inside the ProductSeeder and its factory)
3. `php artisan make:model Order -msfc`
4. `php artisan make:model Company -msfc`

The Company-Seeder only creates exactly one instance of a company which is an exception.
