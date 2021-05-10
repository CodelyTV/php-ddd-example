git clone --depth 1 --branch v1.11.0beta https://github.com/php-amqp/php-amqp.git
cd php-amqp
phpize
./configure
make
make install
