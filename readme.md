Creating a new product and storing it in the database and delete in batch

Create Product

Endpoint: /addProduct.php
Method: POST
Request Body:
{
"product_type": "disc/book/furniture",
"name": "product name",
"price": "product price",
"size": "size of the disc product",
"weight": "weight of the book product",
"height": "height of the furniture product",
"width": "width of the furniture product",
"length": "length of the furniture product"
}
Responses:
201: Product created successfully
400: Invalid request body
Retrieving all products from the database

Get Products

Endpoint: /getProducts.php
Method: GET
Request Body: None
Responses:
200: Success, with a JSON object containing all products
500: Internal Server Error

Deleting multiple products based on their id

Endpoint: /deleteProduct.php
Method: DELETE
Request Body:
{
"skus": ["product_id_1", "product_id_2", "product_id_3", ...]
}
Responses:
201: Product deleted successfully
``
