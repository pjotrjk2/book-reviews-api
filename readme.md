# book-veviews-api

Playground for practical tdd development.

# PHP Storm setup

## Test configurations

In Settings -> PHP -> Test Frameworks, choose PHPUnit by Remote Interpreter, and setup docker interpreter.
Choose "Path to phpunit.xml" and point it to "./phpunit.xml.dist"

## Run/Debug configuration

Make sure Xdebug is on port 9003 as per Docker setup. Check Settings -> Debug -> Xdebug -> port
In Run/Debug configuration, add new Php Web Page using localhost:8080, as per docker configuration. Point it to public/index.php. 