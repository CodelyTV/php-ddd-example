git clone -n https://github.com/php-amqp/php-amqp.git
cd php-amqp
git checkout 96cd5cb5eddd3db2faaa3643dad2fe4677d7c438
phpize
./configure
make
make install
