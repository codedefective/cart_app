# Cart Project

small but effective shopping cart app

## Installation

clone with git and just whisper it to wake up

```bash
git clone https://github.com/codedefective/cart_app.git
```
copy the `env-example` file and name it `.env`

```bash
cd cart_app && mv env-example .env
```

First Start

```bash
docker-compose up
```
This process may take a while. After preparing the containers, Docker will install the dependencies with composer.

While waiting for this process, you need to make a new addition to your host file on your local machine.

```bash
127.0.0.1 test.local
```

all you have to do is access [http://test.local](http://test.local) from your browser

If you are wondering about the details about the docker framework, just type [localhost](http://localhost)  in your browser.

## Usage

Default User's username: `user1@name.com`

Default User's password: `123456`

#Warning

This is a test application. The data in the .app will be restored every time the container is opened!

## Features
- When you log in you will be able to see a number of products
- You can add any product to the basket, and when you add it to the basket, you can see how many of that product is in your cart.
- To access the cart, find the cart from the top menu and stop by
- Here you will see the products in your basket, you can increase, decrease or remove them completely with the help of buttons.
- If you want to try the promo code field below, you will see that it works
- For example, you can try `Easy`, `EasyCep`, `Test` or `Test2`.
- Promo codes are case sensitive.
- If the promo codes remain in the cart even though you have completely removed the products in your cart, the promo codes will also be deleted.
- You can also use multiple promo codes
