# The current directory structure is as follows：
.
|-- README.txt
|-- client
|   |-- js
|   |   |-- des.js
|   |   |-- rsa.js
|   |   `-- sha256.js
|   |-- login.html
|   |-- register.html
|   |-- shoppingcart_needed_login.php
|   `-- user_enter_des_key.php
|-- database
|   |-- deskey.txt
|   |-- shoppingcart.txt
|   `-- users.txt
|-- notuse
|   |-- prcess_cart.php
|   |-- shoppingcart.html
|   `-- shoppingcart_des_4c.html
`-- server
    |-- des.php
    |-- login.php
    |-- logout.php
    |-- prcess_cart_des_4c.php
    |-- private.key
    |-- public.key
    |-- register.php
    |-- rsa.php
    `-- store_des_key_4c.php


# Directory structure description:

- README.txt is the introductory document in the root directory

- client/ folder stored the frontend of the code, the client code, including: encryption and hash js code, login interface, registration interface, shopping cart interface, the user input custom DESKey interface

- database/ folder stores the storage file of the database, including the login registration information for storing the user, the user's DESKey, the user's shopping cart information

- server / folder stored under the server code, including for des encryption and decryption and rsa encryption and decryption of the php code, login registered php processing code, handle the decryption code of the shopping cart, rsa public key private key, registered processing code , Store the code for the DESKey


# Instructions：

- 1. Registration function：

Access the /client/register.html file to register, select whether to check "want to hash your password" will pass the SHA256 hash password to the server

Note: An existing user name can not be registered

- 2. Login function:

Visit /client/login.html file to log in, according to the password used when the registration is the option of whether the hash, the corresponding landing should also be checked, that is, using the hash password registered users need to check the hash Options

Note: landing on the user name will exist and the existence of the user name and the password is to match whether to judge,

Subsequent operations are only allowed to log in to the user to operate

- 3. The user specifies the key for DES:

After accessing the login.html file successfully and successfully logged in, it will automatically jump to the interface, (/ client / user_enter_des_key.php), the user will enter the custom DES key will be stored in the server database (/ database / deskey.txt)

Note: The DES key is submitted to the server in RSA encryption mode

- 4. User access Cart:

After successful login, successfully set deskey will automatically enter the interface, or manually access /client/shoppingcart_needed_login.php page.

Note: Only users who have successfully logged in are allowed to access the interface. Users who are not logged in and who have not set the des key will be redirected to the corresponding interface to complete the above operation.

- 5. User shopping cart information can be changed and submitted:

Access to the shopping cart page, update the items of goods shopping cart options, you can automatically calculate all the prices; at the same time click on the submission, the shopping cart information will be submitted to the server in three ways:

1）To plain text, plain text forms to post the way directly to the server

2）RSA encryption method, the need to encrypt the data with "&" symbol after the link into a string, and then encrypted with RSA passed to the server

3) DES encryption method, the need to encrypt the data with "&" symbol after the link into a string, and then encrypted with DES passed to the server

Note: The minimum number of items purchased per cart is set to 0;

RSA encryption key is in advance agreed;

DES key is the user login successfully set manually after the custom, and save the key in the database;

The server will display the data according to the above three methods respectively

- 6. Service Show Cart:

The server will be based on 5 described in the three forms of data, respectively, analysis and corresponding decryption, and continue to show in the form of Table in the front

- 7. Logout function:

Direct access to /server/logout.php for user logout


# Website portals：

/client/login.html

/client/register.html

/server/logout.php
