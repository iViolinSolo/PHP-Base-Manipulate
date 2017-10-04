# 当前目录结构如下：
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


# 目录结构介绍：

- 根目录下README.txt是介绍性文档

- client/ 文件夹下存储了前端的代码，客户端代码，主要包含：进行加密和hash的js代码，登陆界面，注册界面，购物车界面，用户输入自定义DESKey的界面

- database/ 文件夹下存储了数据库的存储文件，包括用于存储用户的登陆注册信息，用户的DESKey，用户的购物车信息的数据

- server/ 文件夹下存储了服务端代码，包括用于des加密解密和rsa加密解密的php代码，登陆注册的php处理代码，处理购物车的解密代码，rsa的公钥私钥，注册的处理代码，存储DESKey的代码


# 使用方法：

- 1. 注册功能：

访问/client/register.html 文件进行注册，选择是否勾选"want to hash your password" 会传递是否用SHA256哈希过的密码到服务端

注意：已存在的用户名不能进行注册

- 2. 登陆功能：

访问/client/login.html 文件进行登陆，根据注册时选用的密码是否哈希的选项，对应的登陆时也应进行勾选，即使用哈希过密码注册的用户登陆时也需要勾选哈希的选项

注意：登陆时会对用户名是否存在以及存在的用户名和输入的密码是否匹配进行判断，

后续操作仅允许登陆过用户才能操作

- 3. 用户指定DES的key：

访问login.html 文件成功并成功登陆后，会自动跳转到该界面，（/client/user_enter_des_key.php），用户输入的自定义DES 的密钥将会被保存在服务端的数据库中（/database/deskey.txt）

注意：DES密钥会以RSA加密的方式提交给服务端

- 4. 用户访问购物车：

登陆成功后，成功设置deskey后会自动进入该界面，或手动访问 /client/shoppingcart_needed_login.php 页面。

注意：仅允许登陆成功的用户访问该界面，未登陆以及未设置过des key的用户会被重定向到对应的界面完成上述操作。

- 5. 用户购物车信息可以更改并提交：

访问到购物车页面，更新购物车的物品选项，可以自动计算所有的价格；同时点击提交之后，购物车信息会被以三种方式提交到服务端：

1）以plain text的方式，纯文本的表单方式以post的方式直接提交给服务端黛娜

2）以RSA加密的方法，将需要加密的数据用"&"符号链接后拼接成字符串，然后用RSA加密后传递给服务端

3）以DES加密的方法，将需要加密的数据用"&"符号链接后拼接成字符串，然后用DES加密后传递给服务端

注意：购物车每项产品购买数量的最小值被设定为0；

RSA加密的密钥是提前约定好的；

DES的密钥是用户登陆成功后手动设定的自定义的，并保存在数据库中的密钥；

服务端会根据上述三种方式分别进行数据的展示

- 6. 服务端展示购物车信息：

服务端会根据5 中介绍的三种形式的数据，分别进行解析和对应的解密，并继续以Table的形式展现在前端

- 7. 登出功能：

直接访问 /server/logout.php 进行用户登出


# 网站入口：

/client/login.html

/client/register.html

/server/logout.php
