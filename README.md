# Smarthome Product Management
This is a small, school-based project to manage smart-home products for various companies using PHP and Laravel.

## Pages
There is going to be a **dashboard** showing statistics (the number of **Orders**, **Products and Services**) and the configuration/overview items.

On the **orders-page**, one should be able to see a table of orders for customers. If a user clicks on an entry, he/she can edit or delete it and see a more detailed view below.

On the **products- and services-page** you should be able to register new controllers and manage their services by clicking on the controllers.

A **masterpage** should be used for all pages.

## Implementation
The following structure indicates how the Eloquent-ORM-System should be used hierarchically. 

 - **Products**
    - Controller-Name
    - Serial-Number
    - Project-Name
    - **Services**
        - Service-Name
        - Serial-Number
        - Max-Date
        - Enabled-Flag
 - **Orders**
    - Order-Number
    - Ordered-Date
    - Reference-Name
    - State-String
 - **Companies**
    - Company-Name
    - Company-Mail
    - _Contact-Firstname_
    - _Contact-Lastname_
    
The **bold** statements are model classes and the _italic_ ones show that there is only one contact person associated with each company.

### Details for the Model
The following tutorial is used to model the One-To-Many-Relationship regarding **Products** and **Services** (by using Eloquent):
https://laravel.com/docs/8.x/eloquent-relationships#one-to-many

This should result in the ability to use the relationship in the DB.

### Migrations
The Structure from the Implementation-Part is used to infer the four needed migrations:
1. `create_services_table`
2. `create_products_table`
2. `create_orders_table`
3. `create_companies_table`

_Note that the order is important as products have their own services_
 
Additionally, every record should have the `timestamps`-field to be able to check the modification and creation times.

### Controllers
With the used approach, **every Model-Object** is going to have its own Controller-Object, although the Companies-Controller will only be used if no company instance has already been configured, so there is only going to be one company. Thus, the index-Method of the Companies' CRUD-Controller is not implemented. Furthermore, the same Blade-View should be used for **Companies.Show**, **Companies.Edit** and **Companies.Create** in order to save time.

The Controller of the Service is also quite special as the functionality of the Create-Method and the Show-Method is already going to be implemented inside the **Products.Index** Page. The **Products.Index**-Page also obsoletes the **Products.Show** as well as the **Service.Show**-Page as certain elements are going to be highlighted via JS and Bootstrap. The **Orders.Show**-Page is going to be integrated to the **Orders.Index** as well.

The Services-Model-Classes are displayed and managed within the Products-Controller to reduce the overall complexity.

### Seeding
Should be done using a `Factory` for the **Orders** and the **Products** (directly including the **Services**). As there is only one company for the application, no seeder is going to be created for it.
